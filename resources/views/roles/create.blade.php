@extends('layouts.app')
@section('content')
<h2>Add Role</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('roles.store') }}" method="POST">
   @csrf
   <div class="mb-3">
      <label>Role Name</label>
      <input type="text" name="role_name" class="form-control" value="{{ old('role_name') }}" required>
   </div>
   <button class="btn btn-success">Create</button>
</form>
@endsection