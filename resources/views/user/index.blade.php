@extends('layouts.app')
@section('content')

@php
    use Illuminate\Support\Facades\URL;
@endphp

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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<!-- data table js CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables JavaScript and CSS files -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<title>Laravel Crud</title>
</head>

<body>
<div class="container">
    <div class="text-right">
        <a href="user/create" class="btn btn-dark mt-2">Add Details</a>
    </div>
    <h1>Student details</h1>
  @if(Session::has('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
  @endif
  @if(session('danger'))
  <div class="alert alert-danger">
      {{ session('danger') }}
  </div>
@endif
<table class="table table-striped table-hover mt-3" id="userTable">
<thead>
  <tr>
      <th>Sr no.</th>
      <th>Name</th>
      <th>Age</th>
      <th>Email</th>
      <th>image</th>
      <th>Update</th>
      <th>Delete</th>
  </tr> 
</thead>
  <tbody>
    {{-- @foreach ($insert_user as $users)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$users->name}}</td>
        <td>{{$users->age}}</td>
        <td>{{$users->email}}</td>
        <td>
            <img src="storage/user_images/{{ $users->image }}" alt="User Image" width="60" height="60">
        </td>
        <td>
            <a href="user/{{$users->id}}/update" class="btn btn-dark">Update</a>
        </td>
        <td>
            <a href="user/{{$users->id}}/delete" class="btn btn-danger">Delete</a>
        </td>
    </tr>
@endforeach --}}

<script>
  $(document).ready( function () {
    $('#userTable').DataTable({
        "serverSide": true,
        "ajax": "{{ route('users.data') }}",
        "columnDefs":[
            {
              "targets": [4,5,6],
              "searchable": false,
              "orderable": false
            },
        ],
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "age" },
            { "data": "email" },
            {
                data: 'image',
                render: function (data, type, row) {
                    return '<img src="{{ asset('storage/user_images/') }}/' + data + '" alt="User Image" width="60" height="60">';
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                return '<form action="user/' + data.id + '/update" method="get">' +
                        '@csrf' +
                        '<button class="btn btn-dark" type="submit">Update</button>' +
                        '</form>';
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return '<form action="user/' + data.id + '/delete" method="post">' +
                        '@csrf' +
                        '@method("delete")' +
                        '<button class="btn btn-danger" type="submit">Delete</button>' +
                        '</form>';
                }
            }
        ]
    });
});

</script>
      
  </tbody>
  </table>
</div>
</body>
</html>
@endsection