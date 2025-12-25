<?php

use App\Models\Employee;
use App\Models\PayrollCycle;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/payslips')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/payslips')->assertForbidden();
});

it('validates payslip creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/payslips', [])->assertStatus(422);
});

it('handles payslip crud successfully', function () {
    actingAsRole('admin');

    $employee = Employee::factory()->create();
    $cycle = PayrollCycle::factory()->create();

    $payload = [
        'payroll_cycle_id' => $cycle->id,
        'employee_id' => $employee->id,
        'basic_salary' => 3000,
        'total_earnings' => 3500,
        'total_deductions' => 200,
        'net_salary' => 3300,
        'currency_code' => 'USD',
    ];

    $createResponse = $this->postJson('/api/payslips', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $payslipId = $createResponse->json('data.id');

    $this->getJson('/api/payslips')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/payslips/{$payslipId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/payslips/{$payslipId}", [
        'net_salary' => 3200,
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('payslips', [
        'id' => $payslipId,
        'net_salary' => 3200,
    ]);

    $this->deleteJson("/api/payslips/{$payslipId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
