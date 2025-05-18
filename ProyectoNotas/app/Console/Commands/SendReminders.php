<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Notifications\ReminderNotification;
use Carbon\Carbon;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Enviar recordatorios pendientes por correo';

    public function handle()
    {
        $now = Carbon::now();
        $reminders = Reminder::where('sent', false)
            ->where('remind_at', '<=', $now)
            ->get();

        foreach ($reminders as $reminder) {
            $user = $reminder->note->user;
            if ($user && $user->email) {
                $user->notify(new ReminderNotification($reminder));
                $reminder->sent = true;
                $reminder->save();
            }
        }
    }
}