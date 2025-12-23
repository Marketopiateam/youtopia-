<?php

namespace App\Models;

use App\Enums\ConversationType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conversation extends Model
{
    protected $fillable = [
        'type',
        'title',
        'last_message_at',
    ];

    protected $casts = [
        'type' => ConversationType::class,
        'last_message_at' => 'datetime',
    ];

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'conversation_participants')
                   ->withPivot(['joined_at', 'left_at'])
                   ->withTimestamps();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->orderBy('created_at');
    }

    public function latestMessage(): HasOne
    {
        return $this->hasOne(Message::class)->latest();
    }

    public function unreadCountFor(Employee $employee): int
    {
        $lastRead = $this->participants()
                        ->where('employee_id', $employee->id)
                        ->first()
                        ?->pivot
                        ?->last_read_at;

        if (!$lastRead) {
            return $this->messages()->count();
        }

        return $this->messages()
                   ->where('created_at', '>', $lastRead)
                   ->where('sender_employee_id', '!=', $employee->id)
                   ->count();
    }

    public function markAsReadFor(Employee $employee)
    {
        $this->participants()
            ->updateExistingPivot($employee->id, [
                'last_read_at' => now(),
            ]);
    }

    public function addParticipant(Employee $employee)
    {
        $this->participants()->attach($employee->id, [
            'joined_at' => now(),
        ]);
    }

    public function removeParticipant(Employee $employee)
    {
        $this->participants()->updateExistingPivot($employee->id, [
            'left_at' => now(),
        ]);
    }

    public function isDirectMessage(): bool
    {
        return $this->type === ConversationType::Direct;
    }

    public function isGroupMessage(): bool
    {
        return $this->type === ConversationType::Group;
    }
}
