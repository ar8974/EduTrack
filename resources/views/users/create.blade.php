@extends('layouts.app')
@section('content')
<h2>Add User</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul class="mb-0">
      @foreach ($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('users.store') }}" method="POST">
   @csrf
   <div class="mb-3">
      <label>First Name</label>
      <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
   </div>
   <div class="mb-3">
      <label>Last Name</label>
      <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
   </div>
   <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
   </div>
   <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
   </div>
   <div class="mb-3">
      <label>Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-control" required>
   </div>
   <div class="mb-3">
      <label>Role</label>
      <select name="role_id" class="form-control" required>
         <option value="">Select Role</option>
         @foreach($roles as $role)
         <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
         {{ $role->role_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Department</label>
      <select name="dept_id" class="form-control">
         <option value="">Select Department</option>
         @foreach($departments as $dept)
         <option value="{{ $dept->dept_id }}" {{ old('dept_id') == $dept->dept_id ? 'selected' : '' }}>
         {{ $dept->dept_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3 form-check">
      <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active') ? 'checked' : '' }}>
      <label class="form-check-label">Active</label>
   </div>
   <button class="btn btn-success">Create</button>
</form>
@endsection