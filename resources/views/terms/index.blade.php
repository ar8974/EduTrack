@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Academic Terms</h2>
   <a href="{{ route('terms.create') }}" class="btn btn-primary">Add Term</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Term Name</th>
         <th>Start Date</th>
         <th>End Date</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($terms as $term)
      <tr>
         <td>{{ $term->term_id }}</td>
         <td>{{ $term->term_name }}</td>
         <td>{{ $term->start_date }}</td>
         <td>{{ $term->end_date }}</td>
         <td>
            <a href="{{ route('terms.edit', $term) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('terms.destroy', $term) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this term?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection