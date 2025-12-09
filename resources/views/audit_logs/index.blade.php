@extends('layouts.app')
@section('content')
<h2>Audit Logs</h2>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>User</th>
         <th>Action</th>
         <th>Entity</th>
         <th>Entity ID</th>
         <th>Action Time</th>
      </tr>
   </thead>
   <tbody>
      @foreach($logs as $log)
      <tr>
         <td>{{ $log->audit_id }}</td>
         <td>{{ $log->user->first_name ?? '' }} {{ $log->user->last_name ?? '' }}</td>
         <td>{{ $log->action }}</td>
         <td>{{ $log->entity }}</td>
         <td>{{ $log->entity_id }}</td>
         <td>{{ $log->action_time }}</td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection