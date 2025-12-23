<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyGoal extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'quarter',
        'year',
        'status',
        'owner_employee_id',
    ];

    protected $casts = [
        'quarter' => 'integer',
        'year' => 'integer',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'owner_employee_id');
    }

    public function goalLinks(): HasMany
    {
        return $this->hasMany(GoalLink::class, 'goal_id')
            ->where('goal_type', 'company');
    }

    public function objectives()
    {
        return $this->hasManyThrough(
            OkrObjective::class,
            GoalLink::class,
            'goal_id',
            'id',
            'id',
            'objective_id'
        )->where('goal_links.goal_type', 'company');
    }
}
