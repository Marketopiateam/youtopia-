<?php

use App\Enums\LeaveStatus;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/leave-requests')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/leave-requests')->assertForbidden();
});

it('validates leave request creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/leave-requests', [])->assertStatus(422);
});

it('handles leave request crud successfully', function () {
    actingAsRole('admin');

    $employee = Employee::factory()->create();
    $leaveType = LeaveType::factory()->create();

    $payload = [
        'employee_id' => $employee->id,
        'leave_type_id' => $leaveType->id,
        'start_date' => now()->toDateString(),
        'end_date' => now()->addDays(2)->toDateString(),
        'days_count' => 3,
        'reason' => 'Family vacation',
        'status' => LeaveStatus::Pending->value,
    ];

    $createResponse = $this->postJson('/api/leave-requests', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $leaveRequestId = $createResponse->json('data.id');

    $this->getJson('/api/leave-requests')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/leave-requests/{$leaveRequestId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/leave-requests/{$leaveRequestId}", [
        'status' => LeaveStatus::Approved->value,
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('leave_requests', [
        'id' => $leaveRequestId,
        'status' => LeaveStatus::Approved->value,
    ]);

    $this->deleteJson("/api/leave-requests/{$leaveRequestId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
