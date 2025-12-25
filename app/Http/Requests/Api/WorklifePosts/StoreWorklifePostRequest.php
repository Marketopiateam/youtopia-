<?php

namespace App\Http\Requests\Api\WorklifePosts;

use App\Enums\AudienceType;
use App\Enums\WorklifePostType;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreWorklifePostRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'author_employee_id' => ['required', 'exists:employees,id'],
            'source_type' => ['nullable', 'string', 'max:255'],
            'source_id' => ['nullable', 'integer'],
            'post_type' => ['required', Rule::enum(WorklifePostType::class)],
            'content' => ['required', 'string'],
            'audience_type' => ['required', Rule::enum(AudienceType::class)],
            'audience_id' => ['nullable', 'integer'],
            'is_pinned' => ['boolean'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
