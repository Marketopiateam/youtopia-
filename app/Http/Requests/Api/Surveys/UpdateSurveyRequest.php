<?php

namespace App\Http\Requests\Api\Surveys;

use App\Enums\AudienceType;
use App\Enums\SurveyStatus;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Department;
use App\Models\WorklifeGroup;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateSurveyRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'created_by_employee_id' => ['sometimes', 'exists:employees,id'],
            'audience_type' => ['sometimes', Rule::enum(AudienceType::class)],
            'audience_id' => ['sometimes', 'nullable', 'integer'],
            'starts_at' => ['sometimes', 'nullable', 'date'],
            'ends_at' => ['sometimes', 'nullable', 'date', 'after_or_equal:starts_at'],
            'is_anonymous' => ['sometimes', 'boolean'],
            'status' => ['sometimes', Rule::enum(SurveyStatus::class)],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $audienceType = $this->input('audience_type');

            if (! $audienceType) {
                return;
            }

            $audienceId = $this->input('audience_id');

            if ($audienceType === AudienceType::Department->value || $audienceType === AudienceType::Team->value) {
                if (! $audienceId || ! Department::whereKey($audienceId)->exists()) {
                    $validator->errors()->add('audience_id', 'A valid department is required for this audience type.');
                }
            }

            if ($audienceType === AudienceType::Custom->value) {
                if (! $audienceId || ! WorklifeGroup::whereKey($audienceId)->exists()) {
                    $validator->errors()->add('audience_id', 'A valid group is required for custom audience.');
                }
            }
        });
    }
}
