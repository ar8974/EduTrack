<?php

namespace App\Http\Controllers\Faculty;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Question;

class ResponseController extends Controller
{
    public function index()
    {
        $responses = Response::with('question', 'student')->get();
        return view('faculty.responses.index', compact('responses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'response_id' => 'nullable|exists:AR8974_RESPONSE,response_id',
            'score' => 'required|numeric',
            'comments' => 'nullable|string',
        ]);

        $response = Response::find($request->response_id);
        if ($response) {
            $response->update([
                'score' => $request->score,
                'comments' => $request->comments,
            ]);

            return redirect()->back()->with('success', 'Response graded successfully.');
        }

        return redirect()->back()->with('error', 'Response not found.');
    }

    public function destroy(Response $response)
    {
        $response->delete();
        return redirect()->back()->with('success', 'Response deleted successfully.');
    }
}
