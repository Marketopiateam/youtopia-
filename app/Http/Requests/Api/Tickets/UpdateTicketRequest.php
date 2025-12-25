<?php

namespace App\Http\Requests\Api\Tickets;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'exists:users,id'],
            'ticket_type_id' => ['sometimes', 'exists:ticket_types,id'],
            'reason' => ['sometimes', 'string', 'max:1000'],
            'priority' => ['sometimes', Rule::enum(TicketPriority::class)],
            'expected_from' => ['sometimes', 'nullable', 'date'],
            'expected_to' => ['sometimes', 'nullable', 'date', 'after_or_equal:expected_from'],
            'amount' => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'attachments' => ['sometimes', 'nullable', 'array'],
            'status' => ['sometimes', Rule::enum(TicketStatus::class)],
            'submitted_at' => ['sometimes', 'nullable', 'date'],
        ];
    }
}
