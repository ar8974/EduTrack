@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Security Questions</h2>
   <a href="{{ route('security_questions.create') }}" class="btn btn-primary">Add Question</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Question Text</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($questions as $question)
      <tr>
         <td>{{ $question->question_id }}</td>
         <td>{{ $question->question_text }}</td>
         <td>
            <a href="{{ route('security_questions.edit', $question) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('security_questions.destroy', $question) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this question?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection