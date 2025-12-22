<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\Concerns\BuildsFilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketSubmittedNotification extends Notification
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
            'manager' => 'manager',
            'hr' => 'hr',
            'admin' => 'admin',
            'employee' => 'employee',
            default => 'employee'
        };

        // تحديد المحتوى بناءً على نوع المستخدم
        $body = match ($notifiable->default_panel ?? 'employee') {
            'manager' => "طلب جديد #{$this->ticket->id} في انتظار موافقتك كمدير.",
            'admin' => "طلب جديد #{$this->ticket->id} تم تقديمه وهو في انتظار موافقة المدير.",
            default => "تم تقديم طلبك الجديد #{$this->ticket->id} وهو في انتظار موافقة المدير."
        };

        $url = route("filament.{$targetPanel}.resources.tickets.view", ['record' => $this->ticket->id]);

        return $this->buildFilamentDatabaseNotification([
            'title' => 'طلب جديد',
            'body' => $body,
            'ticket_id' => $this->ticket->id,
            'status' => $this->ticket->status->value,
            'url' => $url,
            'icon' => 'heroicon-o-ticket',
            'color' => 'primary',
        ], $url);
    }
}
