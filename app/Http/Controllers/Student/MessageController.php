<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    public function index()
    {
        $studentId = Auth::id() ?? Session::get('user_id');

        $messages = Message::where('sender_id', $studentId)
            ->orWhere('receiver_id', $studentId)
            ->with(['sender', 'receiver'])
            ->orderBy('sent_on', 'desc')
            ->get();

        return view('student.messages.index', compact('messages'));
    }

    public function create()
    {
        $faculty = User::where('role_id', 2)->get();

        return view('student.messages.create', compact('faculty'));
    }

    public function store(Request $request)
    {
        $studentId = Auth::id() ?? Session::get('user_id');

        $request->validate([
            'receiver_id' => 'required|integer|exists:AR8974_USER,user_id',
            'subject'     => 'required|string|max:255',
            'body'        => 'required|string',
        ]);

        Message::create([
            'message_id' => Message::max('message_id') + 1,
            'sender_id'   => $studentId,
            'receiver_id' => $request->receiver_id,
            'subject'     => $request->subject,
            'body'        => $request->body,
            'sent_on'     => now(),
        ]);

        return redirect()->route('student.messages.index')
            ->with('success', 'Message sent successfully.');
    }
}
