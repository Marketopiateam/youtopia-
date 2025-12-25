<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationParticipant extends Model
{
    use HasFactory;
    protected $fillable = [
        'conversation_id',
        'user_id',
    ];

    /**
     * Get the conversation that this participant belongs to.
     */
    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    /**
     * Get the user who is the participant.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the employee associated with this participant user.
     * Assuming a relationship between User and Employee, or that User is the employee.
     */
    public function employee(): BelongsTo
    {
        // This relationship assumes a direct link from User to Employee or that User is the Employee
        // If User is separate from Employee and an Employee model is needed here,
        // it would require a specific relation definition, e.g., $this->user->employee()
        return $this->belongsTo(Employee::class, 'user_id', 'user_id'); // Assuming user_id on Employee table
    }
}
