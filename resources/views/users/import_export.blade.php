@extends('layouts.app')
@section('content')
<div class="container mt-4">
   <h3>User Import / Export</h3>
   <div class="card p-4">
      <h5>Export Users</h5>
      <a href="{{ route('users.export') }}" class="btn btn-success mb-4">
      Download Users CSV
      </a>
      <hr>
      <h5>Import Users</h5>
      <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
         @csrf
         <input type="file" name="file" class="form-control" required>
         <button type="submit" class="btn btn-primary mt-2">Import</button>
      </form>
   </div>
</div>
@endsection