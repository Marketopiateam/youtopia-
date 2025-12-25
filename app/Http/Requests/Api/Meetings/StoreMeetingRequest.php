<?php

namespace App\Http\Requests\Api\Meetings;

use App\Enums\MeetingStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreMeetingRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'scheduled_at' => ['required', 'date'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'location' => ['nullable', 'string', 'max:255'],
            'meeting_link' => ['nullable', 'url', 'max:2048'],
            'organizer_employee_id' => ['required', 'exists:employees,id'],
            'status' => ['nullable', Rule::enum(MeetingStatus::class)],
        ];
    }
}
