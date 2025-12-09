<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Section;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends Controller
{
    public function index()
    {
        $facultyId = Session::get('user_id');
        $announcements = Announcement::where('posted_by', $facultyId)->get();

        return view('faculty.announcements.index', compact('announcements'));
    }

    public function create()
    {
        $facultyId = Session::get('user_id');
        $sections = Section::where('faculty_id', $facultyId)->get();

        return view('faculty.announcements.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required',
            'title'      => 'required',
            'message'    => 'required',
        ]);

        $facultyId = Session::get('user_id');

        Announcement::create([
            'posted_by'    => $facultyId,
            'section_id' => $request->section_id,
            'title'      => $request->title,
            'message'    => $request->message,
            'posted_on'  => now(),
        ]);

        return redirect()->route('faculty.announcements.index')
                         ->with('success', 'Announcement posted.');
    }

    public function edit(Announcement $announcement)
    {
        $facultyId = Session::get('user_id');

        if ($announcement->posted_by != $facultyId) {
            abort(403, 'Unauthorized');
        }

        $sections = Section::where('faculty_id', $facultyId)->get();

        return view('faculty.announcements.create', compact('announcement', 'sections'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $facultyId = Session::get('user_id');

        if ($announcement->posted_by != $facultyId) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'section_id' => 'required',
            'title'      => 'required',
            'message'    => 'required',
        ]);

        $announcement->update([
            'section_id' => $request->section_id,
            'title'      => $request->title,
            'message'    => $request->message,
        ]);

        return redirect()->route('faculty.announcements.index')
                         ->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $facultyId = Session::get('user_id');

        if ($announcement->posted_by != $facultyId) {
            abort(403, 'Unauthorized');
        }

        $announcement->delete();
        return back()->with('success', 'Announcement deleted.');
    }
}
