<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with(relations: 'category')->get();
        return view('notes', compact('notes'));
    }

    public function importantNotes()
    {
        $notes = Note::query()->where('is_important', '1')->with('category')->get();
        return view('notes', compact('notes'));
    }


    public function createNotes(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            // 'is_important' => 'required|boolean',
            'tipo' => 'required|string|max:50',
            'id_category' => 'nullable|exists:category,id',
        ]);

        Note::create([
            ...$validatedData,
            "is_important" => !!$request->is_important,
            "user_id" => Auth::user()->getAuthIdentifier()
        ]);

        return redirect("/notes")->with('success', 'Nota creada correctamente.');
    }

    public function show(Request $request, $id)
    {
        $note = Note::find($id)->with('category')->first();
        return view('notesform', compact('note'));
    }

    public function update(Request $request)
    {
        $note = Note::find($request->id);
        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tipo' => 'required|string|max:50',
            'id_category' => 'nullable|exists:category,id',
        ]);

        if (!empty($validatedData)) {
            $note->fill([
                ...$validatedData,
                "is_important" => !!$request->is_important,
                "user_id" => Auth::user()->getAuthIdentifier()
            ]);
            $note->save();
        }

        return redirect("/notes")->with('success', 'Nota ha sido editada correctamente');
    }


    public function destroy(Request $request, $id)
    {

        $note = Note::find($id);
        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $note->delete();

        return redirect("/notes")->with('success', 'Nota ha sido eliminada correctamente');
    }
}
