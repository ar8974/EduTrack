<?php

namespace App\Http\Controllers;

use App\Models\DiscussionPost;
use App\Models\DiscussionThread;
use App\Models\User;
use Illuminate\Http\Request;

class DiscussionPostController extends Controller
{
    public function index()
    {
        $posts = DiscussionPost::with(['thread', 'user'])->orderBy('posted_on', 'desc')->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $threads = DiscussionThread::all();
        $users = User::all();
        return view('posts.form', compact('threads', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'thread_id' => 'required|integer|exists:AR8974_DISCUSSION_THREAD,thread_id',
            'user_id'   => 'required|integer|exists:AR8974_USER,user_id',
            'message'   => 'required|string',
        ]);

        $data['posted_on'] = now();
        DiscussionPost::create($data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(DiscussionPost $post)
    {
        $threads = DiscussionThread::all();
        $users = User::all();
        return view('posts.form', compact('post', 'threads', 'users'));
    }

    public function update(Request $request, DiscussionPost $post)
    {
        $data = $request->validate([
            'thread_id' => 'required|integer|exists:AR8974_DISCUSSION_THREAD,thread_id',
            'user_id'   => 'required|integer|exists:AR8974_USER,user_id',
            'message'   => 'required|string',
        ]);

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(DiscussionPost $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
