@extends('layouts.app')
@section('content')
<h2>{{ isset($thread) ? 'Edit Thread' : 'Create Thread' }}</h2>
<form action="{{ isset($thread) ? route('threads.update', $thread) : route('threads.store') }}" method="POST">
   @csrf
   @if(isset($thread))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Section</label>
      <select name="section_id" class="form-control" required>
         <option value="">Select Section</option>
         @foreach($sections as $section)
         <option value="{{ $section->section_id }}" {{ (isset($thread) && $thread->section_id == $section->section_id) ? 'selected' : '' }}>
         {{ $section->course->course_name ?? '' }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="{{ $thread->title ?? old('title') }}" required>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection