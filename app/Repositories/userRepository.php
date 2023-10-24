<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryinterface;
use App\Models\insert_user;
use Illuminate\Http\UserRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryinterface
{
    protected $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function all()
    {
        $userID = Auth::user()->id;
        // dd('user_id');
        return insert_user::where('user_id', $userID)->get();
    }
    
    public function store($request)
    {
        try {
            $userId = Auth::user()->id;
            $insertUsers = new insert_user();
           
            if ($request->hasFile('image')) {
                // Use ImageService to handle image upload
                $uploadedFileName = $this->imageService->upload($request->file('image'));
                $insertUsers->image = $uploadedFileName;

                $insertUsers->subject    = $request->subject;
            }
            $insertUsers->name       = $request->name;
            $insertUsers->age        = $request->age;
            $insertUsers->email      = $request->email;
            $insertUsers->password   = $request->password;
            $insertUsers->number     = $request->number;

            $insertUsers->address    = $request->address;
            $insertUsers->fees       = $request->fees;
            $insertUsers->user_id    = $userId;
            // $user = \Auth::user();
            // $user->name;
            $insertUsers->save();
            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating user', 'error' => $e->getMessage()], 500);
        }
    }

    public function edit($request, $id)
    {
        // dd($request->all());
        // try 
        // {
            
            $userId = Auth::user()->id;
            $insertUsers = insert_user::find($id);
            if ($insertUsers) {
                
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $imageFilename = $this->imageService->upload($file);
                    $insertUsers->image = $imageFilename;
                    $insertUsers->subject    = $request->subject;
                }
                
                $insertUsers->name       = $request->name;
                $insertUsers->age        = $request->age;
                $insertUsers->email      = $request->email;
                $insertUsers->password   = $request->password;
                $insertUsers->number     = $request->number;
           
                $insertUsers->address    = $request->address;
                $insertUsers->fees       = $request->fees;
                // $insertUsers->status = $request->status;
                $insertUsers->user_id    = $userId;

                $insertUsers->save();
                
                return response()->json(['message' => 'User updated successfully'], 200);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }

        // } catch (\Exception $e) {
        //     return response()->json(['message' => 'Error updating user', 'error' => $e->getMessage()], 500);
        //     // dd($e->getMessage());
        // }
    }
    public function delete($id)
    {
        try {
            $deleteUsers = insert_user::find($id);
            if ($deleteUsers) {
                $deleteUsers->delete();
                return response()->json(['message' => 'User deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'User not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting user', 'error' => $e->getMessage()], 500);
        }
    }

}

?>