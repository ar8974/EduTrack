@extends('faculty.layouts.app')
@section('content')
<div class="container mt-3">
   <h2>Send Message</h2>
   @if ($errors->any())
   <div class="alert alert-danger">
      <strong>Fix the following errors:</strong>
      <ul>
         @foreach ($errors->all() as $e)
         <li>{{ $e }}</li>
         @endforeach
      </ul>
   </div>
   @endif
   <form method="POST" action="{{ route('faculty.messages.store') }}">
      @csrf
      <div class="mb-3">
         <label class="form-label">Send To (Student)</label>
         <select class="form-select" name="receiver_id" required>
            <option value="">-- Select Student --</option>
            @foreach($students as $s)
            <option value="{{ $s->user_id }}"
            {{ old('receiver_id') == $s->user_id ? 'selected' : '' }}>
            {{ $s->first_name }} ({{ $s->email }})
            </option>
            @endforeach
         </select>
      </div>
      <div class="mb-3">
         <label class="form-label">Subject</label>
         <input type="text" name="subject" class="form-control"
            value="{{ old('subject') }}" required>
      </div>
      <div class="mb-3">
         <label class="form-label">Message</label>
         <textarea name="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
      </div>
      <button class="btn btn-success">Send Message</button>
      <a href="{{ route('faculty.messages.index') }}" class="btn btn-secondary">Cancel</a>
   </form>
</div>
@endsection