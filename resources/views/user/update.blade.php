@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Laravel Crud</title>
</head>
<body>

{{-- <nav class="navbar navbar-expand-sm bg-dark">

<ul class="navbar-nav">
    <li class="nav-item">
    <a class="nav-link text-light" href="/">HOME</a>
    </li>   
</ul>
</nav> --}}
@section('content');
<div class="container ">
<div class="row justify-content-center">
    <div></div>
<h1>Updating Student details</h1>
</div>
<div class="container">
<div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="card p-3 mt-3">
            
        <form method="POST" action="{{ route('user.edit', ['id' => $user->id]) }}"
            enctype="multipart/form-data">
            @method("PUT")
            @csrf 
            
            <div class="form-group">
                <strong> <label for="">Name</label></strong>
            <input type="text"name="name" class="form-control" 
                placeholder="Enter Name" value="{{old('name', $user->name)}}">
                @if($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
            </div>

            <div class="form-group">
                <strong> <label for="">Age</label></strong>
            <input type="number"name="age" class="form-control" 
                    placeholder="Enter Age" value="{{$user->age}}">
                    @if($errors->has('age'))
                    <span class="text-danger">{{$errors->first('age')}}</span>
                @endif
            </div>

            <div class="form-group">
                <strong> <label for="">Email</label></strong>
            <input type="email"name="email" class="form-control" 
                    placeholder="Enter Email" value="{{$user->email}}">
                    @if($errors->has('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                @endif
            </div>

            <div class="form-group">
                <strong> <label for="">Password</label></strong>
            <input type="password" name="password" class="form-control" 
                    placeholder="Enter password" value="{{$user->password}}">
                    @if($errors->has('password'))
                    <span class="text-danger">{{$errors->first('password')}}</span>
                @endif
            </div>

            <div class="form-group">
                <strong> <label for="">Image</label></strong>
                    <input type="file" name="image" class="form-control" value="{{$user->image}}" >
                    @if($errors->has('image'))
                    <span class="text-danger">{{$errors->first('image')}}</span>
                @endif
            </div>

            <div class="form-group">
                <input class="btn btn-dark text-center " type="submit" type="submit" value="update">
            </div>
        </form>
        </div>
    </div>
</div>
</div>
   
    
</body>
</html>
@endsection