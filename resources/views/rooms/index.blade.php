@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
   <h2>Rooms</h2>
   <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a>
</div>
<table class="table table-bordered">
   <thead>
      <tr>
         <th>ID</th>
         <th>Room Name</th>
         <th>Building</th>
         <th>Capacity</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      @foreach($rooms as $room)
      <tr>
         <td>{{ $room->room_id }}</td>
         <td>{{ $room->room_name }}</td>
         <td>{{ $room->building }}</td>
         <td>{{ $room->capacity }}</td>
         <td>
            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('rooms.destroy', $room) }}" method="POST" style="display:inline-block;">
               @csrf
               @method('DELETE')
               <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this room?')">Delete</button>
            </form>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
@endsection