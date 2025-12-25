<?php

use App\Enums\PayrollCycleStatus;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/payroll-cycles')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/payroll-cycles')->assertForbidden();
});

it('validates payroll cycle creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/payroll-cycles', [])->assertStatus(422);
});

it('handles payroll cycle crud successfully', function () {
    actingAsRole('admin');

    $processor = Employee::factory()->create();

    $payload = [
        'year' => 2025,
        'month' => 1,
        'start_date' => '2025-01-01',
        'end_date' => '2025-01-31',
        'status' => PayrollCycleStatus::Processing->value,
        'processed_by_employee_id' => $processor->id,
    ];

    $createResponse = $this->postJson('/api/payroll-cycles', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $cycleId = $createResponse->json('data.id');

    $this->getJson('/api/payroll-cycles')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/payroll-cycles/{$cycleId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/payroll-cycles/{$cycleId}", [
        'status' => PayrollCycleStatus::Processed->value,
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('payroll_cycles', [
        'id' => $cycleId,
        'status' => PayrollCycleStatus::Processed->value,
    ]);

    $this->deleteJson("/api/payroll-cycles/{$cycleId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
