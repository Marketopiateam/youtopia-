<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'ticket_type_id' => $this->ticket_type_id,
            'reason' => $this->reason,
            'priority' => $this->priority?->value ?? $this->priority,
            'expected_from' => $this->expected_from?->toDateString(),
            'expected_to' => $this->expected_to?->toDateString(),
            'amount' => $this->amount,
            'attachments' => $this->attachments,
            'status' => $this->status?->value ?? $this->status,
            'submitted_at' => $this->submitted_at?->toISOString(),
            'manager_approved' => $this->manager_approved,
            'manager_reason' => $this->manager_reason,
            'manager_action_at' => $this->manager_action_at?->toISOString(),
            'manager_actor_email' => $this->manager_actor_email,
            'hr_approved' => $this->hr_approved,
            'hr_reason' => $this->hr_reason,
            'hr_action_at' => $this->hr_action_at?->toISOString(),
            'hr_actor_email' => $this->hr_actor_email,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            'user' => $this->whenLoaded('user', fn () => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]),
            'type' => $this->whenLoaded('type', fn () => [
                'id' => $this->type->id,
                'name' => $this->type->name,
                'code' => $this->type->code,
            ]),
        ];
    }
}
