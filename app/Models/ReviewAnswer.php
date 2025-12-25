<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_id',
        'question_id',
        'answer_text',
        'rating',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
    ];

    public function review(): BelongsTo
    {
        return $this->belongsTo(PerformanceReview::class, 'review_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(ReviewQuestion::class, 'question_id');
    }
}
