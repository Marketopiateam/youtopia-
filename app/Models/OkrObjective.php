<?php

namespace App\Models;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OkrObjective extends Model
{
    use HasFactory;
    protected $fillable = [
        'cycle_id',
        'title',
        'description',
        'scope',
        'scope_id',
        'owner_employee_id',
        'parent_objective_id',
        'progress_percentage',
        'status',
    ];

    protected $casts = [
        'scope' => OKRScope::class,
        'status' => OKRStatus::class,
        'progress_percentage' => 'decimal:2',
    ];

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(OkrCycle::class, 'cycle_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'owner_employee_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_objective_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_objective_id');
    }

    public function keyResults(): HasMany
    {
        return $this->hasMany(OkrKeyResult::class, 'objective_id');
    }

    // Polymorphic relationship for scope (department or employee)
    public function scopeEntity()
    {
        if ($this->scope === OKRScope::Department) {
            return $this->belongsTo(Department::class, 'scope_id');
        }
        if ($this->scope === OKRScope::Employee) {
            return $this->belongsTo(Employee::class, 'scope_id');
        }
        return null;
    }
}
