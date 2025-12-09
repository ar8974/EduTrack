@extends('layouts.app')
@section('content')
<h2>{{ isset($term) ? 'Edit Term' : 'Add Term' }}</h2>
<form action="{{ isset($term) ? route('terms.update', $term) : route('terms.store') }}" method="POST">
   @csrf
   @if(isset($term))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Term Name</label>
      <input type="text" name="term_name" class="form-control" value="{{ $term->term_name ?? old('term_name') }}" required>
   </div>
   <div class="mb-3">
      <label>Start Date</label>
      <input type="date" name="start_date" class="form-control" value="{{ $term->start_date ?? old('start_date') }}" required>
   </div>
   <div class="mb-3">
      <label>End Date</label>
      <input type="date" name="end_date" class="form-control" value="{{ $term->end_date ?? old('end_date') }}" required>
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection