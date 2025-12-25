<?php

namespace App\Http\Requests\Api\OkrObjectives;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateOkrObjectiveRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cycle_id' => ['sometimes', 'exists:okr_cycles,id'],
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'scope' => ['sometimes', Rule::enum(OKRScope::class)],
            'scope_id' => ['sometimes', 'nullable', 'integer'],
            'owner_employee_id' => ['sometimes', 'exists:employees,id'],
            'parent_objective_id' => ['sometimes', 'nullable', 'exists:okr_objectives,id'],
            'progress_percentage' => ['sometimes', 'nullable', 'numeric', 'min:0', 'max:100'],
            'status' => ['sometimes', Rule::enum(OKRStatus::class)],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $scope = $this->input('scope');

            if (! $scope) {
                return;
            }

            $scopeId = $this->input('scope_id');

            if ($scope === OKRScope::Department->value) {
                if (! $scopeId || ! Department::whereKey($scopeId)->exists()) {
                    $validator->errors()->add('scope_id', 'A valid department is required for department scope.');
                }
            }

            if ($scope === OKRScope::Employee->value) {
                if (! $scopeId || ! Employee::whereKey($scopeId)->exists()) {
                    $validator->errors()->add('scope_id', 'A valid employee is required for employee scope.');
                }
            }

            if ($scope === OKRScope::Company->value && $scopeId) {
                $validator->errors()->add('scope_id', 'Scope ID must be empty for company scope.');
            }
        });
    }
}
