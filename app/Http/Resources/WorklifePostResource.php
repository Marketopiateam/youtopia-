<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorklifePostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author_employee_id' => $this->author_employee_id,
            'source_type' => $this->source_type,
            'source_id' => $this->source_id,
            'post_type' => $this->post_type?->value ?? $this->post_type,
            'content' => $this->content,
            'audience_type' => $this->audience_type?->value ?? $this->audience_type,
            'audience_id' => $this->audience_id,
            'is_pinned' => $this->is_pinned,
            'published_at' => $this->published_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'author' => $this->whenLoaded('author', fn () => [
                'id' => $this->author->id,
                'employee_code' => $this->author->employee_code,
            ]),
        ];
    }
}
