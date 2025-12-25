<?php

namespace App\Http\Requests\Api\WorklifePosts;

use App\Enums\AudienceType;
use App\Enums\WorklifePostType;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateWorklifePostRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_employee_id' => ['sometimes', 'exists:employees,id'],
            'source_type' => ['sometimes', 'nullable', 'string', 'max:255'],
            'source_id' => ['sometimes', 'nullable', 'integer'],
            'post_type' => ['sometimes', Rule::enum(WorklifePostType::class)],
            'content' => ['sometimes', 'string'],
            'audience_type' => ['sometimes', Rule::enum(AudienceType::class)],
            'audience_id' => ['sometimes', 'nullable', 'integer'],
            'is_pinned' => ['sometimes', 'boolean'],
            'published_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
