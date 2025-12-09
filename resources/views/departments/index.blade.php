@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Departments</h2>
   <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
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
         <th>Department Name</th>
         <th>Description</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($departments as $dept)
      <tr>
         <td>{{ $dept->dept_id }}</td>
         <td>{{ $dept->dept_name }}</td>
         <td>{{ $dept->description }}</td>
         <td>
            <a href="{{ route('departments.edit', $dept->dept_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('departments.destroy', $dept->dept_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this department?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection