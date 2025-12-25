<?php

namespace App\Http\Requests\Api\Employees;

use App\Enums\EmployeeStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'manager_employee_id' => ['nullable', 'exists:employees,id'],
            'employee_number' => ['nullable', 'integer', 'min:1'],
            'employee_code' => ['nullable', 'string', 'max:32'],
            'status' => ['nullable', Rule::enum(EmployeeStatus::class)],
            'hire_date' => ['required', 'date'],
            'termination_date' => ['nullable', 'date', 'after_or_equal:hire_date'],
        ];
    }
}
