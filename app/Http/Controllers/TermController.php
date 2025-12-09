<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index() {
        $terms = Term::all();
        return view('terms.index', compact('terms'));
    }

    public function create() {
        return view('terms.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'term_name' => 'required|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        Term::create($data);
        return redirect()->route('terms.index')->with('success', 'Term created.');
    }

    public function edit(Term $term) {
        return view('terms.edit', compact('term'));
    }

    public function update(Request $request, Term $term) {
        $data = $request->validate([
            'term_name' => 'required|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date'
        ]);

        $term->update($data);
        return redirect()->route('terms.index')->with('success', 'Term updated.');
    }

    public function destroy(Term $term) {
        $term->delete();
        return redirect()->route('terms.index')->with('success', 'Term deleted.');
    }
}
