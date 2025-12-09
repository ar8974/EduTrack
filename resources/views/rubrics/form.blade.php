@extends('layouts.app')
@section('content')
<h2>{{ isset($rubric) ? 'Edit Rubric' : 'Add Rubric' }}</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ isset($rubric) ? route('rubrics.update', $rubric->rubric_id) : route('rubrics.store') }}" method="POST">
   @csrf
   @if(isset($rubric))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Assignment</label>
      <select name="assignment_id" class="form-control" required>
         <option value="">Select Assignment</option>
         @foreach($assignments as $assignment)
         <option value="{{ $assignment->assignment_id }}" {{ (isset($rubric) && $rubric->assignment_id == $assignment->assignment_id) ? 'selected' : '' }}>
         {{ $assignment->title }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Criterion</label>
      <input type="text" name="criterion" class="form-control" value="{{ $rubric->criterion ?? old('criterion') }}" required>
   </div>
   <div class="mb-3">
      <label>Max Score</label>
      <input type="number" step="0.01" name="max_score" class="form-control" value="{{ $rubric->max_score ?? old('max_score') }}" required>
   </div>
   <button class="btn btn-success">{{ isset($rubric) ? 'Update' : 'Create' }}</button>
</form>
@endsection