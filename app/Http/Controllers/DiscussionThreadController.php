<?php

namespace App\Http\Controllers;

use App\Models\DiscussionThread;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class DiscussionThreadController extends Controller
{
    public function index()
    {
        $threads = DiscussionThread::with(['section', 'creator'])->orderBy('created_on', 'desc')->get();
        return view('threads.index', compact('threads'));
    }

    public function create()
    {
        $sections = Section::all();
        $users = User::all();
        return view('threads.form', compact('sections', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id' => 'required|integer|exists:AR8974_SECTION,section_id',
            'created_by' => 'required|integer|exists:AR8974_USER,user_id',
            'title'      => 'required|string|max:200',
        ]);

        $data['created_on'] = now();
        DiscussionThread::create($data);

        return redirect()->route('threads.index')->with('success', 'Thread created successfully.');
    }

    public function edit(DiscussionThread $thread)
    {
        $sections = Section::all();
        $users = User::all();
        return view('threads.form', compact('thread', 'sections', 'users'));
    }

    public function update(Request $request, DiscussionThread $thread)
    {
        $data = $request->validate([
            'section_id' => 'required|integer|exists:AR8974_SECTION,section_id',
            'created_by' => 'required|integer|exists:AR8974_USER,user_id',
            'title'      => 'required|string|max:200',
        ]);

        $thread->update($data);
        return redirect()->route('threads.index')->with('success', 'Thread updated successfully.');
    }

    public function destroy(DiscussionThread $thread)
    {
        $thread->delete();
        return redirect()->route('threads.index')->with('success', 'Thread deleted successfully.');
    }
}
