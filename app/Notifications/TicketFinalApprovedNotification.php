<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\Concerns\BuildsFilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketFinalApprovedNotification extends Notification
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
            'employee' => 'employee',
            'manager' => 'manager',
            'hr' => 'hr',
            'admin' => 'admin',
            default => 'employee'
        };

        // تحديد المحتوى بناءً على نوع المستخدم
        $body = match ($notifiable->default_panel ?? 'employee') {
            'employee' => "تم الموافقة النهائية على طلبك #{$this->ticket->id} من جميع الأطراف!",
            'manager' => "طلب #{$this->ticket->id} تمت الموافقة النهائية عليه من جميع الأطراف.",
            'hr' => "طلب #{$this->ticket->id} تمت الموافقة النهائية عليه من جميع الأطراف.",
            'admin' => "طلب #{$this->ticket->id} تمت الموافقة النهائية عليه من جميع الأطراف.",
            default => "تم الموافقة النهائية على طلبك #{$this->ticket->id} من جميع الأطراف!"
        };

        $url = route("filament.{$targetPanel}.resources.tickets.view", ['record' => $this->ticket->id]);

        return $this->buildFilamentDatabaseNotification([
            'title' => 'تم الموافقة النهائية',
            'body' => $body,
            'ticket_id' => $this->ticket->id,
            'status' => $this->ticket->status->value,
            'url' => $url,
            'icon' => 'heroicon-o-shield-check',
            'color' => 'success',
        ], $url);
    }
}
