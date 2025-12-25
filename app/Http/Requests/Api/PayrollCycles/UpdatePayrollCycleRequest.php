<?php

namespace App\Http\Requests\Api\PayrollCycles;

use App\Enums\PayrollCycleStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdatePayrollCycleRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'year' => ['sometimes', 'integer', 'min:2000', 'max:2100'],
            'month' => ['sometimes', 'integer', 'min:1', 'max:12'],
            'start_date' => ['sometimes', 'date'],
            'end_date' => ['sometimes', 'date', 'after_or_equal:start_date'],
            'status' => ['sometimes', Rule::enum(PayrollCycleStatus::class)],
            'processed_at' => ['sometimes', 'nullable', 'date'],
            'processed_by_employee_id' => ['sometimes', 'nullable', 'exists:employees,id'],
        ];
    }
}
