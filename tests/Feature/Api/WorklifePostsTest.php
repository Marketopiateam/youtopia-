<?php

use App\Enums\AudienceType;
use App\Enums\WorklifePostType;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('requires authentication', function () {
    $this->getJson('/api/worklife-posts')->assertUnauthorized();
});

it('forbids access without permission', function () {
    actingAsUser();

    $this->getJson('/api/worklife-posts')->assertForbidden();
});

it('validates worklife post creation', function () {
    actingAsRole('admin');

    $this->postJson('/api/worklife-posts', [])->assertStatus(422);
});

it('handles worklife post crud successfully', function () {
    actingAsRole('admin');

    $author = Employee::factory()->create();

    $payload = [
        'author_employee_id' => $author->id,
        'post_type' => WorklifePostType::General->value,
        'content' => 'Team outing this Friday.',
        'audience_type' => AudienceType::Company->value,
        'is_pinned' => true,
    ];

    $createResponse = $this->postJson('/api/worklife-posts', $payload)
        ->assertCreated()
        ->assertJsonPath('success', true);

    $postId = $createResponse->json('data.id');

    $this->getJson('/api/worklife-posts')
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->getJson("/api/worklife-posts/{$postId}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->putJson("/api/worklife-posts/{$postId}", [
        'content' => 'Updated post content.',
    ])->assertOk()->assertJsonPath('success', true);

    $this->assertDatabaseHas('worklife_posts', [
        'id' => $postId,
        'content' => 'Updated post content.',
    ]);

    $this->deleteJson("/api/worklife-posts/{$postId}")
        ->assertOk()
        ->assertJsonPath('success', true);
});
