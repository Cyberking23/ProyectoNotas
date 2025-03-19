<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index() {
        return response()->json(Note::all(), 200);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'tags' => 'nullable|string'
        ]);

        $note = Note::create($request->all());
        return response()->json($note, 201);
    }

    public function show(Note $note) {
        return response()->json($note, 200);
    }

    public function update(Request $request, Note $note) {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'date' => 'sometimes|date',
            'tags' => 'nullable|string'
        ]);

        $note->update($request->all());
        return response()->json($note, 200);
    }

    public function destroy(Note $note) {
        $note->delete();
        return response()->json(['message' => 'Note deleted successfully'], 200);
    }
}