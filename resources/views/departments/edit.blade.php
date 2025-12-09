@extends('layouts.app')
@section('content')
<h2>Edit Department</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ route('departments.update', $department->dept_id) }}" method="POST">
   @csrf
   @method('PUT')
   <div class="mb-3">
      <label>Department Name</label>
      <input type="text" name="dept_name" class="form-control" value="{{ old('dept_name', $department->dept_name) }}" required>
   </div>
   <div class="mb-3">
      <label>Description</label>
      <textarea name="description" class="form-control">{{ old('description', $department->description) }}</textarea>
   </div>
   <button class="btn btn-primary">Update</button>
</form>
@endsection