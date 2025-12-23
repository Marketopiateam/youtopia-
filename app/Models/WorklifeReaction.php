<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class WorklifeReaction extends Model
{
    use HasFactory;

    protected $table = 'worklife_reactions';

    protected $fillable = [
        'reactable_type',
        'reactable_id',
        'employee_id',
        'reaction_type',
    ];

    /**
     * Get the parent reactable model.
     */
    public function reactable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the employee who created the reaction.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
