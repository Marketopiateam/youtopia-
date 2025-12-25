<?php

namespace App\Http\Requests\Api\Payslips;

use App\Http\Requests\Api\ApiFormRequest;

class UpdatePayslipRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payroll_cycle_id' => ['sometimes', 'exists:payroll_cycles,id'],
            'employee_id' => ['sometimes', 'exists:employees,id'],
            'basic_salary' => ['sometimes', 'numeric', 'min:0'],
            'total_earnings' => ['sometimes', 'numeric', 'min:0'],
            'total_deductions' => ['sometimes', 'numeric', 'min:0'],
            'net_salary' => ['sometimes', 'numeric'],
            'currency_code' => ['sometimes', 'string', 'size:3'],
            'generated_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
