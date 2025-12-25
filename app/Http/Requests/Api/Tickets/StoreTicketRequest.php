<?php

namespace App\Http\Requests\Api\Tickets;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreTicketRequest extends ApiFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'ticket_type_id' => ['required', 'exists:ticket_types,id'],
            'reason' => ['required', 'string', 'max:1000'],
            'priority' => ['nullable', Rule::enum(TicketPriority::class)],
            'expected_from' => ['nullable', 'date'],
            'expected_to' => ['nullable', 'date', 'after_or_equal:expected_from'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'attachments' => ['nullable', 'array'],
            'status' => ['nullable', Rule::enum(TicketStatus::class)],
            'submitted_at' => ['nullable', 'date'],
        ];
    }
}
