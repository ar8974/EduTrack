@extends('faculty.layouts.app')
@section('content')
<div class="card">
   <div class="card-header">
      {{ isset($announcement) ? 'Edit Announcement' : 'Create Announcement' }}
   </div>
   <div class="card-body">
      <form action="{{ isset($announcement) ? route('faculty.announcements.update', $announcement) : route('faculty.announcements.store') }}" method="POST">
         @csrf
         @if(isset($announcement))
         @method('PUT')
         @endif
         {{-- User ID comes from session --}}
         <input type="hidden" name="user_id" value="{{ session('user_id') }}">
         <div class="mb-3">
            <label>Section</label>
            <select name="section_id" class="form-select" required>
               <option value="">-- Select Section --</option>
               @foreach($sections as $section)
               <option value="{{ $section->section_id }}" 
               {{ (isset($announcement) && $announcement->section_id == $section->section_id) ? 'selected' : '' }}>
               {{ $section->section_id }}
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
            <textarea name="message" class="form-control" rows="4" required>{{ $announcement->message ?? old('message') }}</textarea>
         </div>
         <button class="btn btn-primary">{{ isset($announcement) ? 'Update' : 'Create' }} Announcement</button>
      </form>
   </div>
</div>
@endsection