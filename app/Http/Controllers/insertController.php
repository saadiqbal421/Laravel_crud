<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\insert_user;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryinterface;
use Yajra\DataTables;

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
      $users = insert_user::select(['id', 'name', 'age', 'email', 'image']);
      return DataTables\Facades\DataTables::of($users)->make(true);
   }

}
?>