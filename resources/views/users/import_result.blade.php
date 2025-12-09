@extends('layouts.app')
@section('content')
<div class="container mt-4">
   <h3>Import Result</h3>
   <p><strong>Successful rows:</strong> {{ $success }}</p>
   @if(count($errors))
   <h4>Errors:</h4>
   <ul class="text-danger">
      @foreach($errors as $e)
      <li>{{ $e }}</li>
      @endforeach
   </ul>
   @endif
   <a href="{{ route('users.import_export') }}" class="btn btn-secondary mt-3">
   Back
   </a>
</div>
@endsection