<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Enums\ConversationType; // Assuming this enum will be created

class Conversation extends Model
{
    // protected $fillable = [ // No fillable based on current minimal migration
    //     'type', // if added
    //     'name', // if added
    // ];

    protected $casts = [
        // 'type' => ConversationType::class, // if added
    ];

    /**
     * Get the messages for the conversation.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the participants of the conversation.
     */
    public function participants(): HasMany
    {
        return $this->hasMany(ConversationParticipant::class);
    }

    /**
     * Get the employees involved in the conversation.
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'conversation_participants', 'conversation_id', 'employee_id')
            ->withTimestamps();
    }
}