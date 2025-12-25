<?php

namespace App\Http\Requests\Api\Employees;

use App\Enums\EmployeeStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'exists:users,id'],
            'department_id' => ['sometimes', 'nullable', 'exists:departments,id'],
            'manager_employee_id' => ['sometimes', 'nullable', 'exists:employees,id'],
            'employee_number' => ['sometimes', 'integer', 'min:1'],
            'employee_code' => ['sometimes', 'string', 'max:32'],
            'status' => ['sometimes', Rule::enum(EmployeeStatus::class)],
            'hire_date' => ['sometimes', 'date'],
            'termination_date' => ['sometimes', 'nullable', 'date', 'after_or_equal:hire_date'],
        ];
    }
}
