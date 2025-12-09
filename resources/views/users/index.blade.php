@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Users</h2>
   <div>
      <a href="{{ route('users.import_export') }}" class="btn btn-success me-2">
      Import / Export Users
      </a>
      <a href="{{ route('users.create') }}" class="btn btn-primary">
      Add User
      </a>
   </div>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email</th>
         <th>Role</th>
         <th>Department</th>
         <th>Active</th>
         <th style="width:180px">Actions</th>
      </tr>
   </thead>
   <tbody>
      @forelse($users as $user)
      <tr>
         <td>{{ $user->user_id }}</td>
         <td>{{ $user->first_name }}</td>
         <td>{{ $user->last_name }}</td>
         <td>{{ $user->email }}</td>
         <td>{{ $user->role->role_name ?? '' }}</td>
         <td>{{ $user->department->dept_name ?? '' }}</td>
         <td>{{ $user->is_active ? 'Yes' : 'No' }}</td>
         <td>
            <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
            </form>
         </td>
      </tr>
      @empty
      <tr>
         <td colspan="8" class="text-center">No users found</td>
      </tr>
      @endforelse
   </tbody>
</table>
@endsection