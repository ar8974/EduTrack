@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Rubrics</h2>
   <a href="{{ route('rubrics.create') }}" class="btn btn-primary">Add Rubric</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Assignment</th>
         <th>Criterion</th>
         <th>Max Score</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($rubrics as $rubric)
      <tr>
         <td>{{ $rubric->rubric_id }}</td>
         <td>{{ $rubric->assignment->title ?? '' }}</td>
         <td>{{ $rubric->criterion }}</td>
         <td>{{ $rubric->max_score }}</td>
         <td>
            <a href="{{ route('rubrics.edit', $rubric->rubric_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('rubrics.destroy', $rubric->rubric_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this rubric?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection