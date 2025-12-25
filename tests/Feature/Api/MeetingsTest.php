<?php

use App\Enums\MeetingStatus;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/meetings')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/meetings')->assertForbidden();
});

it('validates meeting creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/meetings', [])->assertStatus(422);
});

it('handles meeting crud successfully', function () {
    actingAsRole('admin');

    $organizer = Employee::factory()->create();

    $payload = [
        'title' => 'Weekly Sync',
        'scheduled_at' => now()->addDay()->toISOString(),
        'duration_minutes' => 60,
        'organizer_employee_id' => $organizer->id,
        'status' => MeetingStatus::Scheduled->value,
    ];

    $createResponse = $this->postJson('/api/meetings', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $meetingId = $createResponse->json('data.id');

    $this->getJson('/api/meetings')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/meetings/{$meetingId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/meetings/{$meetingId}", [
        'status' => MeetingStatus::Completed->value,
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('meetings', [
        'id' => $meetingId,
        'status' => MeetingStatus::Completed->value,
    ]);

    $this->deleteJson("/api/meetings/{$meetingId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
