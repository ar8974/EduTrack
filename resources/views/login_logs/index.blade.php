@extends('layouts.app')
@section('content')
<h2>Login Logs</h2>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>User</th>
         <th>Login Time</th>
         <th>IP Address</th>
         <th>Device Info</th>
      </tr>
   </thead>
   <tbody>
      @foreach($logs as $log)
      <tr>
         <td>{{ $log->log_id }}</td>
         <td>{{ $log->user->first_name ?? '' }} {{ $log->user->last_name ?? '' }}</td>
         <td>{{ $log->login_time }}</td>
         <td>{{ $log->ip_address }}</td>
         <td>{{ $log->device_info }}</td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection