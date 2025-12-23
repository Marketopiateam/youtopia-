<?php

namespace App\Listeners;

use App\Events\OKRObjectiveCompleted;
use App\Models\WorklifePost;
use App\Enums\WorklifePostType;
use App\Enums\AudienceType;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateWorklifeAchievementPost implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OKRObjectiveCompleted $event): void
    {
        $objective = $event->objective;

        // Determine audience based on objective scope
        $audienceType = AudienceType::Company;
        $audienceId = null;

        if ($objective->scope === 'department') {
            $audienceType = AudienceType::Department;
            $audienceId = $objective->scope_id;
        } elseif ($objective->scope === 'employee') {
            $audienceType = AudienceType::Team; // Assuming team = department
            $audienceId = $objective->owner->department_id;
        }

        WorklifePost::create([
            'author_employee_id' => $objective->owner_employee_id,
            'source_type' => 'App\\Models\\OkrObjective',
            'source_id' => $objective->id,
            'post_type' => WorklifePostType::Achievement,
            'content' => "🎉 Achievement Unlocked!\n\n" .
                        "Objective: {$objective->title}\n" .
                        "Completed by: {$objective->owner->user->name}\n\n" .
                        "Great job on reaching this milestone!",
            'audience_type' => $audienceType,
            'audience_id' => $audienceId,
            'is_pinned' => false,
            'published_at' => now(),
        ]);
    }
}
