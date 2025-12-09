@extends('layouts.app')
@section('content')
<h2>{{ isset($thread) ? 'Edit Thread' : 'Add Thread' }}</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ isset($thread) ? route('threads.update', $thread->thread_id) : route('threads.store') }}" method="POST">
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
         {{ $section->section_id }} - {{ $section->course->course_name ?? '' }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Created By</label>
      <select name="created_by" class="form-control" required>
         <option value="">Select User</option>
         @foreach($users as $user)
         <option value="{{ $user->user_id }}" {{ (isset($thread) && $thread->created_by == $user->user_id) ? 'selected' : '' }}>
         {{ $user->first_name }} {{ $user->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="{{ $thread->title ?? old('title') }}" required>
   </div>
   <button class="btn btn-success">{{ isset($thread) ? 'Update' : 'Create' }}</button>
</form>
@endsection