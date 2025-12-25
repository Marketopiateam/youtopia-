<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_by_employee_id' => $this->created_by_employee_id,
            'audience_type' => $this->audience_type?->value ?? $this->audience_type,
            'audience_id' => $this->audience_id,
            'starts_at' => $this->starts_at?->toISOString(),
            'ends_at' => $this->ends_at?->toISOString(),
            'is_anonymous' => $this->is_anonymous,
            'status' => $this->status?->value ?? $this->status,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'creator' => $this->whenLoaded('creator', fn () => [
                'id' => $this->creator->id,
                'employee_code' => $this->creator->employee_code,
            ]),
        ];
    }
}
