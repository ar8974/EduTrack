@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Rubric Scores</h2>
   <a href="{{ route('rubric_scores.create') }}" class="btn btn-primary">Add Rubric Score</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Rubric</th>
         <th>Submission</th>
         <th>Score</th>
         <th>Comments</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($rubricScores as $score)
      <tr>
         <td>{{ $score->rubric_score_id }}</td>
         <td>{{ $score->rubric->criterion ?? '' }}</td>
         <td>{{ $score->submission->assignment->title ?? '' }} (Student: {{ $score->submission->student->first_name ?? '' }})</td>
         <td>{{ $score->score }}</td>
         <td>{{ $score->comments }}</td>
         <td>
            <a href="{{ route('rubric_scores.edit', $score) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('rubric_scores.destroy', $score) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this score?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection