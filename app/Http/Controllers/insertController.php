<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\insert_user;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryinterface;
use Yajra\DataTables;
use Illuminate\Support\Facades\Auth;



class insertController extends Controller
{
   private $userRepository;
   public function __construct(UserRepositoryinterface $userRepository)
   {
      $this->userRepository = $userRepository;
   }
   public function index()
   {
      $insert_user = $this->userRepository->all();
      return view('user.index', ['insert_user' => insert_user::get()]);
      // return view('user.index', compact('insert_user'));
   }

   public function create()
   {
      return view('user.create');
   }

   public function store(UserRequest $request)
   {
      $this->userRepository->store($request);
      return redirect('/')->with("success", "User added successfully");
   }

   public function update($id)
   {
      $user = insert_user::where('id', $id)->first();
      return view('user.update', ['user' => $user]);
   }

   public function edit(UserRequest $request, $id)
   {
      $this->userRepository->edit($request, $id);
      //dd($this->userRepository->edit($request, $id));
      return redirect('/')->with("success", "User details updated");
   }

   public function delete($id)
   {
      $deleteUsers = insert_user::find($id);
      $deleteUsers->delete();
      return redirect('/')->with("danger", "User Deleted Successfully");
   }

   public function getData(Request $request)
{
    // Get the currently authenticated user's ID
    $userID = Auth::id();

    // Query data for the specific user
    $users = insert_user::where('user_id', $userID)
        ->select(['id', 'name', 'age', 'email', 'image', 'number', 'subject', 'address','fees']);

    return \Yajra\DataTables\DataTables::of($users)->make(true);
}


}
?>