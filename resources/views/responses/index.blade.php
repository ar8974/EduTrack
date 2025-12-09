@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Responses</h2>
   <a href="{{ route('responses.create') }}" class="btn btn-primary">Add Response</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Question</th>
         <th>Student</th>
         <th>Selected Option</th>
         <th>Answer Text</th>
         <th>Score</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($responses as $response)
      <tr>
         <td>{{ $response->response_id }}</td>
         <td>{{ $response->question->question_text ?? '' }}</td>
         <td>{{ $response->student->first_name ?? '' }} {{ $response->student->last_name ?? '' }}</td>
         <td>{{ $response->selectedOption->option_text ?? '' }}</td>
         <td>{{ $response->answer_text }}</td>
         <td>{{ $response->score }}</td>
         <td>
            <a href="{{ route('responses.edit', $response) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('responses.destroy', $response) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this response?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection