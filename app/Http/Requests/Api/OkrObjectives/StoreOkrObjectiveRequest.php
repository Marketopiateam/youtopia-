<?php

namespace App\Http\Requests\Api\OkrObjectives;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreOkrObjectiveRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cycle_id' => ['required', 'exists:okr_cycles,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'scope' => ['required', Rule::enum(OKRScope::class)],
            'scope_id' => ['nullable', 'integer'],
            'owner_employee_id' => ['required', 'exists:employees,id'],
            'parent_objective_id' => ['nullable', 'exists:okr_objectives,id'],
            'progress_percentage' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'status' => ['nullable', Rule::enum(OKRStatus::class)],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $scope = $this->input('scope');
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
