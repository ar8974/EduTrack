<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscussionThread;
use App\Models\Section;
use Illuminate\Support\Facades\Session;

class DiscussionThreadController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');
        $threads = DiscussionThread::where('created_by', $facultyId)->get();
        return view('faculty.threads.index', compact('threads'));
    }

    public function create()
    {
        $sections = Section::where('faculty_id', Session::get('user_id'))->get();
        return view('faculty.threads.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id'=>'required',
            'title'=>'required',
        ]);

        DiscussionThread::create(array_merge($request->all(), ['created_by'=>Session::get('user_id')]));
        return redirect()->route('faculty.threads.index')->with('success','Thread created.');
    }

    public function edit(DiscussionThread $thread)
    {
        $sections = Section::where('faculty_id', Session::get('user_id'))->get();
        return view('faculty.threads.create', compact('thread','sections'));
    }

    public function update(Request $request, DiscussionThread $thread)
    {
        $thread->update($request->all());
        return redirect()->route('faculty.threads.index')->with('success','Thread updated.');
    }

    public function destroy(DiscussionThread $thread)
    {
        $thread->delete();
        return back()->with('success','Thread deleted.');
    }
}
