<?php

namespace App\Http\Requests\Api\LeaveRequests;

use App\Enums\LeaveStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreLeaveRequestRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'exists:employees,id'],
            'leave_type_id' => ['required', 'exists:leave_types,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'days_count' => ['nullable', 'numeric', 'min:0.5'],
            'reason' => ['nullable', 'string', 'max:1000'],
            'status' => ['nullable', Rule::enum(LeaveStatus::class)],
            'submitted_at' => ['nullable', 'date'],
        ];
    }
}
