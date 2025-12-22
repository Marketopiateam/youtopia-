<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\Concerns\BuildsFilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TicketRejectedNotification extends Notification
{
    use Queueable;
    use BuildsFilamentNotification;

    public function __construct(public Ticket $ticket, public string $rejectedBy) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        $rejectedByText = match ($this->rejectedBy) {
            'manager' => 'المدير',
            'hr' => 'الموارد البشرية',
            default => $this->rejectedBy
        };

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
            'employee' => "تم رفض طلبك #{$this->ticket->id} من {$rejectedByText}.",
            'manager' => "طلب #{$this->ticket->id} تم رفضه من {$rejectedByText}.",
            'hr' => "طلب #{$this->ticket->id} تم رفضه من {$rejectedByText}.",
            'admin' => "طلب #{$this->ticket->id} تم رفضه من {$rejectedByText}.",
            default => "تم رفض طلبك #{$this->ticket->id} من {$rejectedByText}."
        };

        $url = route("filament.{$targetPanel}.resources.tickets.view", ['record' => $this->ticket->id]);

        return $this->buildFilamentDatabaseNotification([
            'title' => 'تم رفض الطلب',
            'body' => $body,
            'ticket_id' => $this->ticket->id,
            'status' => $this->ticket->status->value,
            'url' => $url,
            'icon' => 'heroicon-o-x-circle',
            'color' => 'danger',
        ], $url);
    }
}
