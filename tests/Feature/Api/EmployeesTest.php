<?php

use App\Enums\EmployeeStatus;
use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/employees')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/employees')->assertForbidden();
});

it('validates employee creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/employees', [])->assertStatus(422);
});

it('handles employee crud successfully', function () {
    actingAsRole('admin');

    $user = User::factory()->create();
    $department = Department::factory()->create();

    $payload = [
        'user_id' => $user->id,
        'department_id' => $department->id,
        'status' => EmployeeStatus::Active->value,
        'hire_date' => now()->subYear()->toDateString(),
    ];

    $createResponse = $this->postJson('/api/employees', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $employeeId = $createResponse->json('data.id');

    $this->getJson('/api/employees')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/employees/{$employeeId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/employees/{$employeeId}", [
        'status' => EmployeeStatus::Terminated->value,
        'termination_date' => now()->toDateString(),
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('employees', [
        'id' => $employeeId,
        'status' => EmployeeStatus::Terminated->value,
    ]);

    $this->deleteJson("/api/employees/{$employeeId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
