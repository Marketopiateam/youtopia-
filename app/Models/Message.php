<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'conversation_id',
        'sender_employee_id',
        'content',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'sender_employee_id');
    }

    public function reads(): HasMany
    {
        return $this->hasMany(MessageRead::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(MessageAttachment::class);
    }

    public function isReadBy(Employee $employee): bool
    {
        return $this->reads()->where('employee_id', $employee->id)->exists();
    }

    public function markAsReadFor(Employee $employee)
    {
        if (!$this->isReadBy($employee)) {
            $this->reads()->create([
                'employee_id' => $employee->id,
                'read_at' => now(),
            ]);
        }
    }

    public function scopeUnreadFor($query, Employee $employee)
    {
        return $query->whereDoesntHave('reads', function ($q) use ($employee) {
            $q->where('employee_id', $employee->id);
        });
    }

    public function scopeFromEmployee($query, Employee $employee)
    {
        return $query->where('sender_employee_id', $employee->id);
    }
}
