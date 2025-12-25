<?php

namespace App\Http\Requests\Api\Surveys;

use App\Enums\AudienceType;
use App\Enums\SurveyStatus;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Department;
use App\Models\WorklifeGroup;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreSurveyRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'created_by_employee_id' => ['required', 'exists:employees,id'],
            'audience_type' => ['required', Rule::enum(AudienceType::class)],
            'audience_id' => ['nullable', 'integer'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_anonymous' => ['boolean'],
            'status' => ['nullable', Rule::enum(SurveyStatus::class)],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $audienceType = $this->input('audience_type');
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
