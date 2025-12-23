<?php

namespace App\Listeners;

use App\Events\JobPostPublished;
use App\Models\WorklifePost;
use App\Enums\WorklifePostType;
use App\Enums\AudienceType;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateWorklifePostForJobOpening implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(JobPostPublished $event): void
    {
        $jobPost = $event->jobPost;

        WorklifePost::create([
            'author_employee_id' => $jobPost->created_by_employee_id,
            'source_type' => 'App\\Models\\JobPost',
            'source_id' => $jobPost->id,
            'post_type' => WorklifePostType::Auto,
            'content' => "🎉 New Job Opening: {$jobPost->title}\n\n" .
                        "Department: {$jobPost->department->name}\n" .
                        "Apply at: {$jobPost->url}\n\n" .
                        "We're looking for talented individuals to join our team!",
            'audience_type' => AudienceType::Company,
            'audience_id' => null,
            'is_pinned' => false,
            'published_at' => now(),
        ]);
    }
}
