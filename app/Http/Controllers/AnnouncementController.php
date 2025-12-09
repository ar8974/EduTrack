<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    // List all announcements
    public function index()
    {
        $announcements = Announcement::with(['section', 'user'])->orderBy('posted_on', 'desc')->get();
        return view('announcements.index', compact('announcements'));
    }

    // Show create form
    public function create()
    {
        $sections = Section::all();
        $users = User::all();
        return view('announcements.create', compact('sections', 'users'));
    }

    // Store a new announcement
    public function store(Request $request)
    {
        $data = $request->validate([
            'section_id' => 'nullable|integer|exists:AR8974_SECTION,section_id',
            'posted_by'  => 'nullable|integer|exists:AR8974_USER,user_id',
            'title'      => 'required|string|max:200',
            'message'    => 'required|string',
            'posted_on'  => 'nullable|date',
        ]);

        Announcement::create($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully.');
    }

    // Show edit form
    public function edit(Announcement $announcement)
    {
        $sections = Section::all();
        $users = User::all();
        return view('announcements.edit', compact('announcement', 'sections', 'users'));
    }

    // Update an announcement
    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'section_id' => 'nullable|integer|exists:AR8974_SECTION,section_id',
            'posted_by'  => 'nullable|integer|exists:AR8974_USER,user_id',
            'title'      => 'required|string|max:200',
            'message'    => 'required|string',
            'posted_on'  => 'nullable|date',
        ]);

        $announcement->update($data);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully.');
    }

    // Delete an announcement
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully.');
    }
}
