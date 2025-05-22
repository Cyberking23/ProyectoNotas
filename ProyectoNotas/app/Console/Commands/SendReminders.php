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
        $now = Carbon::now()->timezone('America/El_Salvador');
        $reminders = Reminder::where('sent', false)
            ->where('remind_at', '<=', $now);
            // ->get();


        foreach ($reminders->get() as $reminder) {
            $user = $reminder->note->user;

            if ($user && $user->email) {
                $user->notify(new ReminderNotification($reminder));

                // Log to Laravel log file
                Log::info("ENVIANDO recordatorio a {$user->email}");

                // Output to terminal
                $this->info("✅ ENVIADO a {$user->email}");

                $reminder->sent = true;
                $reminder->save();
            } else {
                Log::warning("Recordatorio no enviado: usuario sin email o inválido para nota {$reminder->note_id}");
                $this->warn("⚠️ Usuario inválido para el recordatorio con ID {$reminder->id}");
            }
        }

    }
}