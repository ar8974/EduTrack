@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Roles</h2>
   <a href="{{ route('roles.create') }}" class="btn btn-primary">Add Role</a>
</div>
@if(session('success'))
<div class="alert alert-success">
   {{ session('success') }}
</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Role Name</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($roles as $role)
      <tr>
         <td>{{ $role->role_id }}</td>
         <td>{{ $role->role_name }}</td>
         <td>
            <a href="{{ route('roles.edit', $role->role_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('roles.destroy', $role->role_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this role?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection