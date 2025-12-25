<?php

use App\Enums\AudienceType;
use App\Enums\SurveyStatus;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/surveys')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/surveys')->assertForbidden();
});

it('validates survey creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/surveys', [])->assertStatus(422);
});

it('handles survey crud successfully', function () {
    actingAsRole('admin');

    $creator = Employee::factory()->create();

    $payload = [
        'title' => 'Engagement Survey',
        'description' => 'Quarterly engagement survey',
        'created_by_employee_id' => $creator->id,
        'audience_type' => AudienceType::Company->value,
        'starts_at' => now()->toISOString(),
        'ends_at' => now()->addWeek()->toISOString(),
        'is_anonymous' => true,
        'status' => SurveyStatus::Draft->value,
    ];

    $createResponse = $this->postJson('/api/surveys', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $surveyId = $createResponse->json('data.id');

    $this->getJson('/api/surveys')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/surveys/{$surveyId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/surveys/{$surveyId}", [
        'status' => SurveyStatus::Published->value,
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('surveys', [
        'id' => $surveyId,
        'status' => SurveyStatus::Published->value,
    ]);

    $this->deleteJson("/api/surveys/{$surveyId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
