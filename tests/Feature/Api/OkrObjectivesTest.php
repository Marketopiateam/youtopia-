<?php

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use App\Models\Department;
use App\Models\Employee;
use App\Models\OkrCycle;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/okr-objectives')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/okr-objectives')->assertForbidden();
});

it('validates okr objective creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/okr-objectives', [])->assertStatus(422);
});

it('handles okr objective crud successfully', function () {
    actingAsRole('admin');

    $cycle = OkrCycle::factory()->create();
    $owner = Employee::factory()->create();
    $department = Department::factory()->create();

    $payload = [
        'cycle_id' => $cycle->id,
        'title' => 'Improve Customer Satisfaction',
        'scope' => OKRScope::Department->value,
        'scope_id' => $department->id,
        'owner_employee_id' => $owner->id,
        'status' => OKRStatus::Active->value,
    ];

    $createResponse = $this->postJson('/api/okr-objectives', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $objectiveId = $createResponse->json('data.id');

    $this->getJson('/api/okr-objectives')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/okr-objectives/{$objectiveId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/okr-objectives/{$objectiveId}", [
        'status' => OKRStatus::OnTrack->value,
        'progress_percentage' => 42.5,
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('okr_objectives', [
        'id' => $objectiveId,
        'status' => OKRStatus::OnTrack->value,
    ]);

    $this->deleteJson("/api/okr-objectives/{$objectiveId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
