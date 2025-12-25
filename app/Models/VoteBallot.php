<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoteBallot extends Model
{
    use HasFactory;
    protected $fillable = [
        'vote_id',
        'employee_id',
        'option_id',
        'voted_at',
    ];

    protected $casts = [
        'voted_at' => 'datetime',
    ];

    /**
     * Get the vote that this ballot belongs to.
     */
    public function vote(): BelongsTo
    {
        return $this->belongsTo(Vote::class);
    }

    /**
     * Get the employee who cast this ballot.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Get the option that was voted for.
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(VoteOption::class, 'option_id');
    }
}
