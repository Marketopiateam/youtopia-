<?php

namespace App\Http\Requests\Api\Payslips;

use App\Http\Requests\Api\ApiFormRequest;

class StorePayslipRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payroll_cycle_id' => ['required', 'exists:payroll_cycles,id'],
            'employee_id' => ['required', 'exists:employees,id'],
            'basic_salary' => ['required', 'numeric', 'min:0'],
            'total_earnings' => ['required', 'numeric', 'min:0'],
            'total_deductions' => ['required', 'numeric', 'min:0'],
            'net_salary' => ['required', 'numeric'],
            'currency_code' => ['required', 'string', 'size:3'],
            'generated_at' => ['nullable', 'date'],
        ];
    }
}
