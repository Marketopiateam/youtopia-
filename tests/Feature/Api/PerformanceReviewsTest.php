<?php

use App\Enums\ReviewStatus;
use App\Models\Employee;
use App\Models\PerformanceReviewTemplate;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/performance-reviews')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/performance-reviews')->assertForbidden();
});

it('validates performance review creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/performance-reviews', [])->assertStatus(422);
});

it('handles performance review crud successfully', function () {
    actingAsRole('admin');

    $template = PerformanceReviewTemplate::factory()->create();
    $employee = Employee::factory()->create();
    $reviewer = Employee::factory()->create();

    $payload = [
        'template_id' => $template->id,
        'employee_id' => $employee->id,
        'reviewer_employee_id' => $reviewer->id,
        'review_period_start' => now()->subMonth()->toDateString(),
        'review_period_end' => now()->toDateString(),
        'overall_rating' => 4.2,
        'status' => ReviewStatus::Draft->value,
    ];

    $createResponse = $this->postJson('/api/performance-reviews', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $reviewId = $createResponse->json('data.id');

    $this->getJson('/api/performance-reviews')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/performance-reviews/{$reviewId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/performance-reviews/{$reviewId}", [
        'status' => ReviewStatus::Completed->value,
        'submitted_at' => now()->toISOString(),
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('performance_reviews', [
        'id' => $reviewId,
        'status' => ReviewStatus::Completed->value,
    ]);

    $this->deleteJson("/api/performance-reviews/{$reviewId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
