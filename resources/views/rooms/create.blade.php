@extends('layouts.app')
@section('content')
<h2>{{ isset($room) ? 'Edit Room' : 'Add Room' }}</h2>
<form action="{{ isset($room) ? route('rooms.update', $room) : route('rooms.store') }}" method="POST">
   @csrf
   @if(isset($room))
   @method('PUT')
   @endif
   <div class="mb-3">
      <label>Room Name</label>
      <input type="text" name="room_name" class="form-control" value="{{ $room->room_name ?? old('room_name') }}" required>
   </div>
   <div class="mb-3">
      <label>Building</label>
      <input type="text" name="building" class="form-control" value="{{ $room->building ?? old('building') }}">
   </div>
   <div class="mb-3">
      <label>Capacity</label>
      <input type="number" name="capacity" class="form-control" value="{{ $room->capacity ?? old('capacity') }}">
   </div>
   <button class="btn btn-success">Save</button>
</form>
@endsection