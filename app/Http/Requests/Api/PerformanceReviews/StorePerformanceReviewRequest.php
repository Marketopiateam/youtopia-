<?php

namespace App\Http\Requests\Api\PerformanceReviews;

use App\Enums\ReviewStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StorePerformanceReviewRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'template_id' => ['required', 'exists:performance_review_templates,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'reviewer_employee_id' => ['required', 'exists:employees,id', 'different:employee_id'],
            'review_period_start' => ['required', 'date'],
            'review_period_end' => ['required', 'date', 'after_or_equal:review_period_start'],
            'overall_rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'summary' => ['nullable', 'string'],
            'status' => ['nullable', Rule::enum(ReviewStatus::class)],
            'submitted_at' => ['nullable', 'date'],
        ];
    }
}
