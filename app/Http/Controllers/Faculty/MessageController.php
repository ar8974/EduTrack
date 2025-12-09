<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    // List all messages for this faculty
    public function index()
    {
        $facultyId = Session::get('user_id');

        $messages = Message::where('sender_id', $facultyId)
            ->orWhere('receiver_id', $facultyId)
            ->with(['sender', 'receiver'])
            ->orderBy('sent_on', 'desc')
            ->get();

        return view('faculty.messages.index', compact('messages'));
    }

    // Show create message form
    public function create()
    {
        $facultyId = Session::get('user_id');

        // Faculty can message students only (role_id = 3)
        $students = User::where('role_id', 3)->get();

        return view('faculty.messages.create', compact('students'));
    }

    // Store a new message
    public function store(Request $request)
    {
        $facultyId = Session::get('user_id');

        $request->validate([
            'receiver_id' => 'required|integer|exists:AR8974_USER,user_id',
            'subject'     => 'required|string|max:255',
            'body'        => 'required|string',
        ]);

        Message::create([
            'message_id' => Message::max('message_id') + 1,
            'sender_id'   => $facultyId,
            'receiver_id' => $request->receiver_id,
            'subject'     => $request->subject,
            'body'        => $request->body,
            'sent_on'     => now(),
        ]);

        return redirect()->route('faculty.messages.index')
            ->with('success', 'Message sent successfully.');
    }
}
