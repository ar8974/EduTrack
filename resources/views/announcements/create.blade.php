@extends('layouts.app')
@section('content')
<h2>{{ isset($announcement) ? 'Edit Announcement' : 'Add Announcement' }}</h2>
@if ($errors->any())
<div class="alert alert-danger">
   <ul>
      @foreach($errors->all() as $err)
      <li>{{ $err }}</li>
      @endforeach
   </ul>
</div>
@endif
<form action="{{ isset($announcement) ? route('announcements.update', $announcement->announcement_id) : route('announcements.store') }}" method="POST">
   @csrf
   @if(isset($announcement))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Section</label>
      <select name="section_id" class="form-control">
         <option value="">Select Section</option>
         @foreach($sections as $section)
         <option value="{{ $section->section_id }}" {{ (isset($announcement) && $announcement->section_id == $section->section_id) ? 'selected' : '' }}>
         {{ $section->course->course_code ?? '' }} - Section {{ $section->section_id }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Posted By</label>
      <select name="posted_by" class="form-control">
         <option value="">Select User</option>
         @foreach($users as $user)
         <option value="{{ $user->user_id }}" {{ (isset($announcement) && $announcement->posted_by == $user->user_id) ? 'selected' : '' }}>
         {{ $user->first_name }} {{ $user->last_name }}
         </option>
         @endforeach
      </select>
   </div>
   <div class="mb-3">
      <label>Title</label>
      <input type="text" name="title" class="form-control" value="{{ $announcement->title ?? old('title') }}" required>
   </div>
   <div class="mb-3">
      <label>Message</label>
      <textarea name="message" class="form-control" required>{{ $announcement->message ?? old('message') }}</textarea>
   </div>
   <div class="mb-3">
      <label>Posted On</label>
      <input type="datetime-local" name="posted_on" class="form-control" value="{{ isset($announcement) ? \Carbon\Carbon::parse($announcement->posted_on)->format('Y-m-d\TH:i') : old('posted_on') }}">
   </div>
   <button class="btn btn-success">{{ isset($announcement) ? 'Update' : 'Create' }}</button>
</form>
@endsection