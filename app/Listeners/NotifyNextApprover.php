<?php

namespace App\Listeners;

use App\Events\ApprovalActionTaken;
use App\Models\ApprovalRequest;
use App\Models\ApprovalStep;
use App\Notifications\ApprovalRequestNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyNextApprover implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ApprovalActionTaken $event): void
    {
        $approvalRequest = $event->approvalRequest;

        // If approved and there are more steps, notify next approver
        if ($event->action === 'approved' && $approvalRequest->hasNextStep()) {
            $nextStep = $approvalRequest->getNextStep();

            if ($nextStep && $nextStep->approver_employee_id) {
                $nextStep->approver->user->notify(
                    new ApprovalRequestNotification($approvalRequest, 'pending_approval')
                );
            }
        }
    }
}
