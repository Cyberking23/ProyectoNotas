<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

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
    
        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'date' => $request->date,
            'tags' => $request->tags,
            'user_id' => 1
        ]);
    
        return response()->json($note, 201);
    }

    public function show(Note $note) {
        return response()->json($note, 200);
    }

    public function update(Request $request, $id) {
        $note = Note::find($id);
        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }
    
        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'date' => 'sometimes|date',
            'tags' => 'nullable|string'
        ]);
    
        if (!empty($validatedData)) {
            $note->fill($validatedData);
            $note->save();
        }
    
        return response()->json($note);
    }
    

    public function destroy(Note $note) {
        $note->delete();
        return response()->json(['message' => 'Note deleted successfully'], 200);
    }
}