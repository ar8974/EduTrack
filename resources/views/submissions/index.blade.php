@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Submissions</h2>
   <a href="{{ route('submissions.create') }}" class="btn btn-primary">Add Submission</a>
</div>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Assignment</th>
         <th>Student</th>
         <th>Submitted On</th>
         <th>File Path</th>
         <th>Grade</th>
         <th>Feedback</th>
         <th>Graded By</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($submissions as $submission)
      <tr>
         <td>{{ $submission->submission_id }}</td>
         <td>{{ $submission->assignment->title ?? '' }}</td>
         <td>{{ $submission->student->first_name ?? '' }} {{ $submission->student->last_name ?? '' }}</td>
         <td>{{ \Carbon\Carbon::parse($submission->submitted_on)->format('d M Y H:i') }}</td>
         <td>{{ $submission->file_path }}</td>
         <td>{{ $submission->grade }}</td>
         <td>{{ \Illuminate\Support\Str::limit($submission->feedback, 50) }}</td>
         <td>{{ $submission->grader->first_name ?? '' }} {{ $submission->grader->last_name ?? '' }}</td>
         <td>
            <a href="{{ route('submissions.edit', $submission->submission_id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('submissions.destroy', $submission->submission_id) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this submission?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection