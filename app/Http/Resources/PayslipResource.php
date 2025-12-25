<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PayslipResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'payroll_cycle_id' => $this->payroll_cycle_id,
            'employee_id' => $this->employee_id,
            'basic_salary' => $this->basic_salary,
            'total_earnings' => $this->total_earnings,
            'total_deductions' => $this->total_deductions,
            'net_salary' => $this->net_salary,
            'currency_code' => $this->currency_code,
            'generated_at' => $this->generated_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'payroll_cycle' => $this->whenLoaded('payrollCycle', fn () => [
                'id' => $this->payrollCycle->id,
                'year' => $this->payrollCycle->year,
                'month' => $this->payrollCycle->month,
            ]),
            'employee' => $this->whenLoaded('employee', fn () => [
                'id' => $this->employee->id,
                'employee_code' => $this->employee->employee_code,
            ]),
        ];
    }
}
