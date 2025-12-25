<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerformanceReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'template_id' => $this->template_id,
            'employee_id' => $this->employee_id,
            'reviewer_employee_id' => $this->reviewer_employee_id,
            'review_period_start' => $this->review_period_start?->toDateString(),
            'review_period_end' => $this->review_period_end?->toDateString(),
            'overall_rating' => $this->overall_rating,
            'summary' => $this->summary,
            'status' => $this->status?->value ?? $this->status,
            'submitted_at' => $this->submitted_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'template' => $this->whenLoaded('template', fn () => [
                'id' => $this->template->id,
                'name' => $this->template->name,
            ]),
            'employee' => $this->whenLoaded('employee', fn () => [
                'id' => $this->employee->id,
                'employee_code' => $this->employee->employee_code,
            ]),
            'reviewer' => $this->whenLoaded('reviewer', fn () => [
                'id' => $this->reviewer->id,
                'employee_code' => $this->reviewer->employee_code,
            ]),
        ];
    }
}
