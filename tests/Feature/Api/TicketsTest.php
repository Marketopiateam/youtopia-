<?php

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/tickets')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/tickets')->assertForbidden();
});

it('validates ticket creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/tickets', [])->assertStatus(422);
});

it('handles ticket crud successfully', function () {
    actingAsRole('admin');

    Notification::fake();

    $user = User::factory()->create();
    $ticketType = TicketType::factory()->create();

    $payload = [
        'user_id' => $user->id,
        'ticket_type_id' => $ticketType->id,
        'reason' => 'Need approval for travel expenses',
        'priority' => TicketPriority::Medium->value,
        'status' => TicketStatus::PendingManager->value,
    ];

    $createResponse = $this->postJson('/api/tickets', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $ticketId = $createResponse->json('data.id');

    $this->getJson('/api/tickets')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/tickets/{$ticketId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/tickets/{$ticketId}", [
        'status' => TicketStatus::Approved->value,
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('tickets', [
        'id' => $ticketId,
        'status' => TicketStatus::Approved->value,
    ]);

    $this->deleteJson("/api/tickets/{$ticketId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
