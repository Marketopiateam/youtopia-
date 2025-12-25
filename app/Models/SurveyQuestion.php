<?php

namespace App\Models;

use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SurveyQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_id',
        'question_text',
        'question_type',
        'is_required',
        'order',
    ];

    protected $casts = [
        'question_type' => QuestionType::class,
        'is_required' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the survey that the question belongs to.
     */
    public function survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }

    /**
     * Get the options for a multiple choice question.
     */
    public function options(): HasMany
    {
        return $this->hasMany(SurveyQuestionOption::class);
    }

    /**
     * Get the answers given for this question.
     */
    public function answers(): HasMany
    {
        return $this->hasMany(SurveyAnswer::class);
    }
}
