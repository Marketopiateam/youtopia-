<?php

namespace App\Http\Requests\Api\LeaveRequests;

use App\Enums\LeaveStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateLeaveRequestRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => ['sometimes', 'exists:employees,id'],
            'leave_type_id' => ['sometimes', 'exists:leave_types,id'],
            'start_date' => ['sometimes', 'date'],
            'end_date' => ['sometimes', 'date', 'after_or_equal:start_date'],
            'days_count' => ['sometimes', 'nullable', 'numeric', 'min:0.5'],
            'reason' => ['sometimes', 'nullable', 'string', 'max:1000'],
            'status' => ['sometimes', Rule::enum(LeaveStatus::class)],
            'submitted_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
