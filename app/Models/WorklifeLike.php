<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorklifeLike extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
    ];

    /**
     * Get the post that the like belongs to.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(WorklifePost::class);
    }

    /**
     * Get the user who made the like.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}