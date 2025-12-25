<?php

namespace App\Models;

use App\Enums\OKRStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OkrKeyResult extends Model
{
    use HasFactory;
    protected $fillable = [
        'objective_id',
        'title',
        'description',
        'target_value',
        'current_value',
        'unit',
        'weight_percentage',
        'status',
    ];

    protected $casts = [
        'target_value' => 'decimal:2',
        'current_value' => 'decimal:2',
        'weight_percentage' => 'integer',
        'status' => OKRStatus::class,
    ];

    public function objective(): BelongsTo
    {
        return $this->belongsTo(OkrObjective::class, 'objective_id');
    }

    public function checkins(): HasMany
    {
        return $this->hasMany(OkrCheckin::class, 'key_result_id');
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->target_value == 0) {
            return 0;
        }
        return min(100, ($this->current_value / $this->target_value) * 100);
    }
}
