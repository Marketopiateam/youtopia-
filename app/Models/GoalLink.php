<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class GoalLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'goal_type',
        'goal_id',
        'objective_id',
    ];

    public function objective(): BelongsTo
    {
        return $this->belongsTo(OkrObjective::class, 'objective_id');
    }

    public function goal(): MorphTo
    {
        return $this->morphTo('goal', 'goal_type', 'goal_id');
    }

    public function companyGoal(): BelongsTo
    {
        return $this->belongsTo(CompanyGoal::class, 'goal_id');
    }

    public function departmentGoal(): BelongsTo
    {
        return $this->belongsTo(DepartmentGoal::class, 'goal_id');
    }
}
