<?php

namespace App\Http\Controllers;

use App\Notifications\ReminderNotification;
use App\Models\Reminder;
use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{
    public function create()
    {
        $notes = Note::where('user_id', Auth::id())->get();
        return view('reminderform', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note_id' => 'required|exists:notes,id',
            'remind_at' => 'required|date',
        ]);

        Reminder::create([
            'note_id' => $request->note_id,
            'remind_at' => $request->remind_at,
            'name' => 'Recordatorio de nota',
            'activo' => true,
        ]);

        return redirect('/reminders')->with('success', 'Recordatorio creado correctamente.');
    }

    public function upcoming()
    {
        $reminders = Reminder::whereHas('note', function ($q) {
            $q->where('user_id', Auth::id());
        })
            ->where('sent', false)
            ->orderBy('remind_at')
            ->get();

        return view('reminderslist', compact('reminders'));
    }
    public function destroy($id)
    {
        $reminder = Reminder::where($id);
        if(!$reminder){
            return redirect()->route('reminders.upcoming');    
        }
        $reminder->delete();

        return redirect()->route('reminders.upcoming')->with('success', 'Recordatorio eliminado correctamente.');
    }
}
