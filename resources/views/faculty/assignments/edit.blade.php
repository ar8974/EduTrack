@extends('faculty.layouts.app')
@section('content')
<div class="container">
   <h2>{{ isset($assignment) ? 'Edit Assignment' : 'Create Assignment' }}</h2>
   <form method="POST" action="{{ isset($assignment) ? route('faculty.assignments.update', $assignment) : route('faculty.assignments.store') }}">
      @csrf
      @if(isset($assignment))
      @method('PUT')
      @endif
      <div class="mb-3">
         <label class="form-label">Section</label>
         <select name="section_id" class="form-select" required>
            <option value="">-- Select Section --</option>
            @foreach($sections as $section)
            <option value="{{ $section->section_id }}" {{ isset($assignment) && $assignment->section_id == $section->section_id ? 'selected' : '' }}>
            {{ $section->section_name }}
            </option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Title</label>
         <input type="text" name="title" class="form-control" required
            value="{{ isset($assignment) ? $assignment->title : '' }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Description</label>
         <textarea name="description" class="form-control" rows="3" required>{{ isset($assignment) ? $assignment->description : '' }}</textarea>
      </div>
      <div class="mb-3">
         <label class="form-label">Due Date</label>
         <input type="date" name="due_date" class="form-control" required
            value="{{ isset($assignment) ? $assignment->due_date : '' }}">
      </div>
      <div class="mb-3">
         <label class="form-label">Team-Based?</label>
         <select name="is_team_based" class="form-select" required>
         <option value="0" {{ isset($assignment) && !$assignment->is_team_based ? 'selected' : '' }}>No</option>
         <option value="1" {{ isset($assignment) && $assignment->is_team_based ? 'selected' : '' }}>Yes</option>
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Total Points</label>
         <input type="number" name="total_points" class="form-control" required
            value="{{ isset($assignment) ? $assignment->total_points : '' }}">
      </div>
      <button class="btn btn-primary">{{ isset($assignment) ? 'Update Assignment' : 'Create Assignment' }}</button>
   </form>
</div>
@endsection