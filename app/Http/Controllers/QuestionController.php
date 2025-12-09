<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Exam;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index() {
        $questions = Question::with('exam', 'options')->get();
        return view('questions.index', compact('questions'));
    }

    public function create() {
        $exams = Exam::all();
        return view('questions.create', compact('exams'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'exam_id' => 'required|integer',
            'question_text' => 'required|string',
            'question_type' => 'required|in:MCQ,Short Answer,Coding',
            'points' => 'nullable|numeric'
        ]);

        $question = Question::create($data);

        if ($request->filled('options') && $request->question_type === 'MCQ') {
            foreach ($request->options as $opt) {
                Option::create([
                    'question_id' => $question->question_id,
                    'option_text' => $opt['text'],
                    'is_correct' => $opt['is_correct'] ?? 0
                ]);
            }
        }

        return redirect()->route('questions.index')->with('success', 'Question created.');
    }

    public function edit(Question $question) {
        $exams = Exam::all();
        return view('questions.edit', compact('question', 'exams'));
    }

    public function update(Request $request, Question $question) {
        $data = $request->validate([
            'exam_id' => 'required|integer',
            'question_text' => 'required|string',
            'question_type' => 'required|in:MCQ,Short Answer,Coding',
            'points' => 'nullable|numeric'
        ]);

        $question->update($data);
        return redirect()->route('questions.index')->with('success', 'Question updated.');
    }

    public function destroy(Question $question) {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted.');
    }
}
