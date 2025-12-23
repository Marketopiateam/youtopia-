<?php

namespace App\Models;

use App\Enums\OKRStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OkrCycle extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => OKRStatus::class,
    ];

    public function objectives(): HasMany
    {
        return $this->hasMany(OkrObjective::class, 'cycle_id');
    }
}
