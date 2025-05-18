<?php

namespace App\Notifications;

use App\Models\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReminderNotification extends Notification
{
    use Queueable;

    public $reminder;

    public function __construct(Reminder $reminder)
    {
        $this->reminder = $reminder;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Tienes un recordatorio pendiente')
            ->greeting('¡Hola!')
            ->line('Tienes un recordatorio para la nota: ' . $this->reminder->note->title)
            ->line('Contenido: ' . $this->reminder->note->content)
            ->line('Fecha y hora: ' . \Carbon\Carbon::parse($this->reminder->remind_at)->format('d/m/Y H:i'))
            ->action('Ver tus notas', url('/notes'))
            ->line('¡No olvides revisar tu recordatorio!');
    }
}