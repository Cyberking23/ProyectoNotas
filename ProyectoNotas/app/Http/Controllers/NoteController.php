<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
   public function index(Request $request)
    {
        $categories = \App\Models\Category::all();
        $query = \App\Models\Note::with('category');

        if ($request->filled('category_id')) {
            $query->where('id_category', $request->category_id);
        }
        
        $query->where('user_id', auth()->id());
        $notes = $query->get();

        return view('Notes', compact('notes', 'categories'));
    }

    public function importantNotes()
    {
        $categories = \App\Models\Category::all();
        $notes = \App\Models\Note::query()
        ->where('user_id', auth()->id())
        ->where('is_important', '1')->with('category')->get();
        return view('Notes', compact('notes', 'categories'));
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
        $categories = Category::where('user_id', auth()->id())->get();
        return view('NotesForm', compact('note', 'categories'));
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
        // dd($validatedData);

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
