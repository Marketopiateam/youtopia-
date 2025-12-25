<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SurveyAnswer extends Model
{
    use HasFactory;
    protected $fillable = [
        'survey_response_id',
        'survey_question_id',
        'answer_text',
        'survey_question_option_id',
    ];

    /**
     * Get the survey response that this answer belongs to.
     */
    public function response(): BelongsTo
    {
        return $this->belongsTo(SurveyResponse::class, 'survey_response_id');
    }

    /**
     * Get the survey question that this answer is for.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(SurveyQuestion::class, 'survey_question_id');
    }

    /**
     * Get the selected option if this is a multiple-choice answer.
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(SurveyQuestionOption::class, 'survey_question_option_id');
    }
}
