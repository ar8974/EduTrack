@extends('faculty.layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Submissions</h2>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>Submission ID</th>
         <th>Assignment</th>
         <th>Student</th>
         <th>Submitted On</th>
         <th>File</th>
         <th>Score</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($submissions as $submission)
      <tr>
         <td>{{ $submission->submission_id }}</td>
         <td>{{ $submission->assignment->title ?? 'N/A' }}</td>
         <td>
            {{ $submission->student->first_name ?? 'Unknown' }}
            {{ $submission->student->last_name ?? '' }}
         </td>
         <td>{{ $submission->submitted_on }}</td>
         <td>
            @if($submission->file_path)
            <a href="{{ asset('storage/'.$submission->file_path) }}" target="_blank">Download</a>
            @else
            No File
            @endif
         </td>
         <td>{{ $submission->score ?? '—' }}</td>
         <td>
            <a href="{{ route('faculty.submissions.edit', $submission->submission_id) }}"
               class="btn btn-sm btn-warning">Grade</a>
            <form action="{{ route('faculty.submissions.destroy', $submission->submission_id) }}"
               method="POST"
               style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger"
                  onclick="return confirm('Delete this submission?')">
               Delete
               </button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection