<?php

namespace App\Http\Requests\Api\Meetings;

use App\Enums\MeetingStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateMeetingRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'scheduled_at' => ['sometimes', 'date'],
            'duration_minutes' => ['sometimes', 'integer', 'min:1'],
            'location' => ['sometimes', 'nullable', 'string', 'max:255'],
            'meeting_link' => ['sometimes', 'nullable', 'url', 'max:2048'],
            'organizer_employee_id' => ['sometimes', 'exists:employees,id'],
            'status' => ['sometimes', Rule::enum(MeetingStatus::class)],
        ];
    }
}
