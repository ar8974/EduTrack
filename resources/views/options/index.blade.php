@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Options</h2>
   <a href="{{ route('options.create') }}" class="btn btn-primary">Add Option</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Question</th>
         <th>Option Text</th>
         <th>Correct</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($options as $option)
      <tr>
         <td>{{ $option->option_id }}</td>
         <td>{{ $option->question->question_text ?? '' }}</td>
         <td>{{ $option->option_text }}</td>
         <td>{{ $option->is_correct ? 'Yes' : 'No' }}</td>
         <td>
            <a href="{{ route('options.edit', $option) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('options.destroy', $option) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this option?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection