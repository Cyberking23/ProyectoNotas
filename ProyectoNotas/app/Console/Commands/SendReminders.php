<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Enviar recordatorios pendientes por correo';

    public function handle()
    {
        $now = Carbon::now();
        $reminders = Reminder::where('sent', false)
            ->orWhere('remind_at', '<=', $now)
            ->get();

        foreach ($reminders as $reminder) {
            $user = $reminder->note->user;
            if ($user && $user->email) {
                $user->notify(new ReminderNotification($reminder));
                Log::info("ENVIANDO");
                $reminder->sent = true;
                $reminder->save();
            }
        }
    }
}