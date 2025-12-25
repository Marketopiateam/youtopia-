<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReviewQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'template_id',
        'question_text',
        'question_type',
        'weight',
        'order',
    ];

    protected $casts = [
        'weight' => 'integer',
        'order' => 'integer',
    ];

    public function template(): BelongsTo
    {
        return $this->belongsTo(PerformanceReviewTemplate::class, 'template_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(ReviewAnswer::class, 'question_id');
    }
}
