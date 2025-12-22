<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\Concerns\BuildsFilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketManagerApprovedNotification extends Notification
{
    use Queueable;
    use BuildsFilamentNotification;

    public function __construct(public Ticket $ticket) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        // تحديد الـ panel بناءً على نوع المستخدم المستلم
        $targetPanel = match ($notifiable->default_panel ?? 'employee') {
            'hr' => 'hr',
            'employee' => 'employee',
            'admin' => 'admin',
            'manager' => 'manager',
            default => 'employee'
        };

        // تحديد المحتوى بناءً على نوع المستخدم
        $body = match ($notifiable->default_panel ?? 'employee') {
            'hr' => "طلب #{$this->ticket->id} تم الموافقة عليه من المدير وهو في انتظار موافقتك.",
            'employee' => "تم الموافقة على طلبك #{$this->ticket->id} من المدير والآن في انتظار موافقة الموارد البشرية.",
            'admin' => "طلب #{$this->ticket->id} تم الموافقة عليه من المدير وهو في انتظار موافقة HR.",
            default => "تم الموافقة على طلبك #{$this->ticket->id} من المدير والآن في انتظار موافقة الموارد البشرية."
        };

        $url = route("filament.{$targetPanel}.resources.tickets.view", ['record' => $this->ticket->id]);

        return $this->buildFilamentDatabaseNotification([
            'title' => 'تم الموافقة من المدير',
            'body' => $body,
            'ticket_id' => $this->ticket->id,
            'status' => $this->ticket->status->value,
            'url' => $url,
            'icon' => 'heroicon-o-check-circle',
            'color' => 'success',
        ], $url);
    }
}
