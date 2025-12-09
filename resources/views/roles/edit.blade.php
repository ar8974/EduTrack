@extends('layouts.app')
@section('content')
<h2>Edit Role</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('roles.update', $role->role_id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="mb-3">
      <label>Role Name</label>
      <input type="text" name="role_name" class="form-control" value="{{ old('role_name', $role->role_name) }}" required>
   </div>
   <button class="btn btn-primary">Update</button>
</form>
@endsection