<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VoteOption extends Model
{
    protected $fillable = [
        'vote_id',
        'option_text',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get the vote that this option belongs to.
     */
    public function vote(): BelongsTo
    {
        return $this->belongsTo(Vote::class);
    }

    /**
     * Get the ballots cast for this option.
     */
    public function ballots(): HasMany
    {
        return $this->hasMany(VoteBallot::class, 'vote_option_id');
    }
}
