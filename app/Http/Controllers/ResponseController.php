<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function index() {
        $responses = Response::with('student', 'question', 'selectedOption')->get();
        return view('responses.index', compact('responses'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'question_id' => 'required|integer',
            'student_id' => 'required|integer',
            'selected_option_id' => 'nullable|integer',
            'answer_text' => 'nullable|string',
            'score' => 'nullable|numeric'
        ]);

        Response::create($data);
        return redirect()->back()->with('success', 'Response recorded.');
    }

    public function destroy(Response $response) {
        $response->delete();
        return redirect()->back()->with('success', 'Response deleted.');
    }
}
