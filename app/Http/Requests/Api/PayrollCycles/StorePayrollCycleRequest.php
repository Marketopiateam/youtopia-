<?php

namespace App\Http\Requests\Api\PayrollCycles;

use App\Enums\PayrollCycleStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StorePayrollCycleRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'status' => ['nullable', Rule::enum(PayrollCycleStatus::class)],
            'processed_at' => ['nullable', 'date'],
            'processed_by_employee_id' => ['nullable', 'exists:employees,id'],
        ];
    }
}
