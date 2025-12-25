<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OkrObjectiveResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cycle_id' => $this->cycle_id,
            'title' => $this->title,
            'description' => $this->description,
            'scope' => $this->scope?->value ?? $this->scope,
            'scope_id' => $this->scope_id,
            'owner_employee_id' => $this->owner_employee_id,
            'parent_objective_id' => $this->parent_objective_id,
            'progress_percentage' => $this->progress_percentage,
            'status' => $this->status?->value ?? $this->status,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'cycle' => $this->whenLoaded('cycle', fn () => [
                'id' => $this->cycle->id,
                'name' => $this->cycle->name,
            ]),
            'owner' => $this->whenLoaded('owner', fn () => [
                'id' => $this->owner->id,
                'employee_code' => $this->owner->employee_code,
            ]),
            'parent' => $this->whenLoaded('parent', fn () => [
                'id' => $this->parent->id,
                'title' => $this->parent->title,
            ]),
        ];
    }
}
