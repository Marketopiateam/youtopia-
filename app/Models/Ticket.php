<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Notifications\TicketSubmittedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'ticket_type_id',

        'reason',

        'priority',
        'expected_from',
        'expected_to',
        'amount',
        'attachments',

        'status',
        'submitted_at',

        'manager_approved',
        'manager_reason',
        'manager_action_at',
        'manager_actor_email',

        'hr_approved',
        'hr_reason',
        'hr_action_at',
        'hr_actor_email',
    ];

    protected $casts = [
        'priority' => TicketPriority::class,
        'status' => TicketStatus::class,

        'expected_from' => 'date',
        'expected_to' => 'date',
        'amount' => 'decimal:2',
        'attachments' => 'array',

        'submitted_at' => 'datetime',
        'manager_action_at' => 'datetime',
        'hr_action_at' => 'datetime',

        'manager_approved' => 'boolean',
        'hr_approved' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employee(): HasOne
    {
        // employee.user_id = ticket.user_id
        return $this->hasOne(Employee::class, 'user_id', 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    protected static function booted()
    {
        static::creating(function (Ticket $ticket) {
            if (! $ticket->status) {
                $ticket->status = TicketStatus::PendingManager;
            }

        });

        static::created(function (Ticket $ticket) {
            // إرسال إشعار للمدير عند إنشاء التيكت الجديد
            if ($ticket->employee?->manager_employee_id) {
                $managerEmployee = Employee::find($ticket->employee->manager_employee_id);

                if ($managerEmployee && $managerEmployee->user) {
                    $managerEmployee->user->notify(new TicketSubmittedNotification($ticket));
                }
            }

            // إرسال إشعار للادمن أيضاً
            $adminUsers = User::query()
                ->where('default_panel', 'admin')
                ->get();

            foreach ($adminUsers as $admin) {
                $admin->notify(new TicketSubmittedNotification($ticket));
            }

            // إرسال إشعار للموظف نفسه
            if ($ticket->user) {
                $ticket->user->notify(new TicketSubmittedNotification($ticket));
            }
        });
    }
}
