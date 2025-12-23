<?php

namespace App\Listeners;

use App\Events\MeetingCreated;
use App\Models\WorklifePost;
use App\Enums\WorklifePostType;
use App\Enums\AudienceType;
use App\Notifications\MeetingReminderNotification;
use Illuminate\Support\Facades\Notification;

class CreateWorklifeAnnouncementForMeeting
{
    public function handle(MeetingCreated $event): void
    {
        // Create worklife announcement
        WorklifePost::create([
            'author_employee_id' => $event->meeting->organizer_employee_id,
            'source_type' => 'meeting',
            'source_id' => $event->meeting->id,
            'post_type' => WorklifePostType::Announcement,
            'content' => "Upcoming Meeting: {$event->meeting->title} at {$event->meeting->scheduled_at->format('M j, Y g:i A')}",
            'audience_type' => AudienceType::Team,
            'audience_id' => null, // Will be filtered by attendees
            'is_pinned' => false,
            'published_at' => now(),
        ]);

        // Send notifications to attendees (schedule for 1 hour before)
        $notificationTime = $event->meeting->scheduled_at->subHour();

        if ($notificationTime->isFuture()) {
            $event->meeting->attendees->each(function ($attendee) use ($event, $notificationTime) {
                if ($attendee->employee->user) {
                    $attendee->employee->user->notify(
                        (new MeetingReminderNotification($event->meeting))
                            ->delay($notificationTime)
                    );
                }
            });
        }
    }
}
