<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    // List all messages
    public function index()
    {
        $messages = Message::with(['sender', 'receiver'])
            ->orderBy('sent_on', 'desc')
            ->get();

        return view('messages.index', compact('messages'));
    }

    // Show form to create message
    public function create()
    {
        $users = User::all();
        return view('messages.form', compact('users'));
    }

    // Store a new message
    public function store(Request $request)
    {
        $request->validate([
            'sender_id'   => 'required|integer|exists:AR8974_USER,user_id',
            'receiver_id' => 'required|integer|exists:AR8974_USER,user_id',
            'subject'     => 'required|string|max:255',
            'body'        => 'required|string',
            'sent_on'     => 'nullable|date',
        ]);

        Message::create([
             'message_id' => Message::max('message_id') + 1,
            'sender_id'   => Session::get('user_id'),
            'receiver_id' => $request->receiver_id,
            'subject'     => $request->subject,
            'body'        => $request->body,
            'sent_on'     => now(),
        ]);

        return redirect()->route('messages.index')
            ->with('success', 'Message sent successfully.');
    }


    // Delete a message
    public function destroy($id)
    {
        $message = Message::where('message_id', $id)->firstOrFail();
        $message->delete();

        return redirect()->route('messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
