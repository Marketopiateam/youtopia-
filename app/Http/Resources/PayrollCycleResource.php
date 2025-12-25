<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollCycleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'year' => $this->year,
            'month' => $this->month,
            'start_date' => $this->start_date?->toDateString(),
            'end_date' => $this->end_date?->toDateString(),
            'status' => $this->status?->value ?? $this->status,
            'processed_at' => $this->processed_at?->toISOString(),
            'processed_by_employee_id' => $this->processed_by_employee_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'processed_by' => $this->whenLoaded('processedBy', fn () => [
                'id' => $this->processedBy->id,
                'employee_code' => $this->processedBy->employee_code,
            ]),
        ];
    }
}
