<?php

namespace App\Http\Requests\Api\PerformanceReviews;

use App\Enums\ReviewStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdatePerformanceReviewRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'template_id' => ['sometimes', 'exists:performance_review_templates,id'],
            'employee_id' => ['sometimes', 'exists:employees,id'],
            'reviewer_employee_id' => ['sometimes', 'exists:employees,id', 'different:employee_id'],
            'review_period_start' => ['sometimes', 'date'],
            'review_period_end' => ['sometimes', 'date', 'after_or_equal:review_period_start'],
            'overall_rating' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:5'],
            'summary' => ['sometimes', 'nullable', 'string'],
            'status' => ['sometimes', Rule::enum(ReviewStatus::class)],
            'submitted_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
