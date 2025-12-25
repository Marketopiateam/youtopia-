<?php

namespace App\Services;

use App\Enums\ApprovalActionType;
use App\Enums\ApprovalApproverType;
use App\Enums\ApprovalStatus;
use App\Models\ApprovalAction;
use App\Models\ApprovalRequest;
use App\Models\ApprovalStep;
use App\Models\ApprovalWorkflow;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ApprovalWorkflowService
{
    /**
     * Finds an active approval workflow for a given entity type.
     *
     * @param string $entityType The type of entity (e.g., 'leave_request', 'ticket').
     * @param int|null $departmentId Optional department ID to find a specific workflow.
     * @return ApprovalWorkflow|null
     */
    public function findActiveWorkflow(string $entityType, ?int $departmentId = null): ?ApprovalWorkflow
    {
        $query = ApprovalWorkflow::query()
            ->where('entity_type', $entityType)
            ->where('is_active', true)
            ->with('steps'); // Eager load steps for performance

        if ($departmentId !== null) {
            $query->where('department_id', $departmentId);
        } else {
            // Prioritize workflows with specific department over global ones if both exist
            $query->whereNull('department_id');
        }

        // Add sorting to ensure consistent workflow selection if multiple match
        $query->orderBy('department_id', 'desc'); // Department-specific first
        $query->orderBy('created_at', 'desc'); // Latest active workflow

        return $query->first();
    }

    /**
     * Submits a new entity for approval.
     *
     * @param Employee $requester The employee submitting the request.
     * @param Model $requestable The entity to be approved (e.g., LeaveRequest).
     * @param ApprovalWorkflow $workflow The workflow to use.
     * @return ApprovalRequest
     * @throws \Exception If the workflow has no steps defined.
     */
    public function submitForApproval(Employee $requester, Model $requestable, ApprovalWorkflow $workflow): ApprovalRequest
    {
        if ($workflow->steps->isEmpty()) {
            throw new \Exception('Approval workflow has no steps defined.');
        }

        return DB::transaction(function () use ($requester, $requestable, $workflow) {
            $approvalRequest = ApprovalRequest::create([
                'workflow_id' => $workflow->id,
                'requestable_type' => $requestable->getMorphClass(),
                'requestable_id' => $requestable->id,
                'requester_employee_id' => $requester->id,
                'current_step' => 1,
                'status' => ApprovalStatus::Pending, // Initially pending
                'submitted_at' => now(),
            ]);

            $this->advanceToNextStep($approvalRequest);

            // TODO: Dispatch ApprovalSubmitted event
            // event(new ApprovalSubmitted($approvalRequest));

            return $approvalRequest;
        });
    }

    /**
     * Advances the approval request to the next step.
     * Handles auto-approval and escalation.
     *
     * @param ApprovalRequest $approvalRequest
     * @return ApprovalRequest The updated approval request.
     */
    public function advanceToNextStep(ApprovalRequest $approvalRequest): ApprovalRequest
    {
        return DB::transaction(function () use ($approvalRequest) {
            $currentStepNumber = $approvalRequest->current_step;
            $workflow = $approvalRequest->workflow;
            $steps = $workflow->steps;

            // Find the next step
            $nextStep = $steps->firstWhere('step_order', $currentStepNumber);

            if (!$nextStep) {
                // No more steps, workflow is complete
                $approvalRequest->status = ApprovalStatus::Approved;
                $approvalRequest->completed_at = now();
                $approvalRequest->save();

                // TODO: Dispatch ApprovalApproved event
                // event(new ApprovalApproved($approvalRequest));

                return $approvalRequest;
            }

            // Determine actual approvers for the current step
            $approvers = $this->resolveApproversForStep($nextStep, $approvalRequest->requester, $approvalRequest->requestable);

            if ($approvers->isEmpty()) {
                // If no approvers found for a required step, it could be an error or auto-escalate
                if ($nextStep->is_required) {
                    // Option 1: Mark as rejected or escalate immediately
                    // For now, let's treat it as a rejection for a required step with no approver
                    return $this->rejectApproval($approvalRequest, 'No approver found for required step ' . $nextStep->step_order, null);
                } else {
                    // If not required and no approver, auto-approve this step and advance
                    $this->recordSystemAction($approvalRequest, $nextStep, ApprovalActionType::AutoApproved, 'No approver found for optional step, auto-approved.');
                    $approvalRequest->current_step++;
                    $approvalRequest->status = ApprovalStatus::InProgress;
                    $approvalRequest->save();
                    return $this->advanceToNextStep($approvalRequest); // Recursively advance
                }
            }

            // At least one approver found, set status to InProgress and save
            $approvalRequest->status = ApprovalStatus::InProgress;
            $approvalRequest->save();

            // TODO: Notify approvers for the current step
            // event(new NotifyNextApprover($approvalRequest, $nextStep, $approvers));

            return $approvalRequest;
        });
    }

    /**
     * Resolves the actual employees who are approvers for a given step.
     *
     * @param ApprovalStep $step
     * @param Employee $requester
     * @param Model $requestable
     * @return \Illuminate\Support\Collection<Employee>
     */
    protected function resolveApproversForStep(ApprovalStep $step, Employee $requester, Model $requestable): \Illuminate\Support\Collection
    {
        $approvers = collect();

        switch ($step->approver_type) {
            case ApprovalApproverType::Employee:
                if ($step->approver_employee_id) {
                    $approver = Employee::find($step->approver_employee_id);
                    if ($approver) {
                        $approvers->push($approver);
                    }
                }
                break;
            case ApprovalApproverType::Role:
                // Assuming approver_role stores a role name (e.g., 'admin', 'hr_manager')
                // This requires a robust permissions/roles system
                // For now, returning employees with a 'User' relation that has the role
                $employeesWithRole = Employee::whereHas('user', function ($query) use ($step) {
                    $query->whereHas('roles', function ($q) use ($step) {
                        $q->where('name', $step->approver_role);
                    });
                })->get();
                $approvers = $approvers->merge($employeesWithRole);
                break;
            case ApprovalApproverType::DepartmentHead:
                // Assuming requestable (e.g., LeaveRequest) has a 'department' relation
                // or the requester has a department.
                // For simplicity, let's assume requester's department head
                if ($requester->department_id) {
                    $departmentHead = Employee::where('department_id', $requester->department_id)
                        ->whereHas('user', fn($query) => $query->whereHas('roles', fn($q) => $q->where('name', 'department_head')))
                        ->first();
                    if ($departmentHead) {
                        $approvers->push($departmentHead);
                    }
                }
                break;
            case ApprovalApproverType::Manager:
                // Assuming Employee model has a 'manager' relationship
                if ($requester->manager) {
                    $approvers->push($requester->manager);
                }
                break;
            case ApprovalApproverType::Custom:
                // This would involve more complex logic, potentially based on $step->approver_role
                // acting as a key to a custom resolver class or method.
                // For now, leave empty or throw exception if not handled.
                break;
        }

        return $approvers;
    }

    /**
     * Approves an approval request for the current step.
     *
     * @param ApprovalRequest $approvalRequest
     * @param Employee $approver
     * @param string|null $notes
     * @return ApprovalRequest
     * @throws \Exception If the approver is not authorized for the current step.
     */
    public function approveRequest(ApprovalRequest $approvalRequest, Employee $approver, ?string $notes = null): ApprovalRequest
    {
        return DB::transaction(function () use ($approvalRequest, $approver, $notes) {
            if (!$this->isApproverAuthorized($approvalRequest, $approver)) {
                throw new \Exception('Approver not authorized for this step.');
            }

            $currentStep = $approvalRequest->workflow->steps->firstWhere('step_order', $approvalRequest->current_step);
            $this->recordAction($approvalRequest, $currentStep, $approver, ApprovalActionType::Approve, $notes);

            $approvalRequest->current_step++; // Move to the next step
            $approvalRequest->save();

            // Automatically advance to the next step
            return $this->advanceToNextStep($approvalRequest);
        });
    }

    /**
     * Rejects an approval request.
     *
     * @param ApprovalRequest $approvalRequest
     * @param string $reason
     * @param Employee|null $approver The employee rejecting the request, or null if system rejection.
     * @return ApprovalRequest
     */
    public function rejectApproval(ApprovalRequest $approvalRequest, string $reason, ?Employee $approver = null): ApprovalRequest
    {
        return DB::transaction(function () use ($approvalRequest, $reason, $approver) {
            $currentStep = $approvalRequest->workflow->steps->firstWhere('step_order', $approvalRequest->current_step);
            $this->recordAction($approvalRequest, $currentStep, $approver, ApprovalActionType::Reject, $reason);

            $approvalRequest->status = ApprovalStatus::Rejected;
            $approvalRequest->completed_at = now();
            $approvalRequest->save();

            // TODO: Implement safe rollback of requestable entity if needed by business logic
            // (e.g., if a leave request was provisionally granted, now revoke it)
            // This would likely involve an event or a dedicated method on the requestable model.

            // TODO: Dispatch ApprovalRejected event
            // event(new ApprovalRejected($approvalRequest));

            return $approvalRequest;
        });
    }

    /**
     * Records an approval action.
     *
     * @param ApprovalRequest $approvalRequest
     * @param ApprovalStep $step
     * @param Employee|null $approver The employee who acted, or null for system actions.
     * @param ApprovalActionType $actionType
     * @param string|null $notes
     * @return ApprovalAction
     */
    protected function recordAction(ApprovalRequest $approvalRequest, ApprovalStep $step, ?Employee $approver, ApprovalActionType $actionType, ?string $notes): ApprovalAction
    {
        return ApprovalAction::create([
            'approval_request_id' => $approvalRequest->id,
            'step_id' => $step->id,
            'approver_employee_id' => $approver?->id,
            'action' => $actionType,
            'notes' => $notes,
            'acted_at' => now(),
        ]);
    }

    /**
     * Records a system-level approval action (e.g., auto-approved step).
     *
     * @param ApprovalRequest $approvalRequest
     * @param ApprovalStep $step
     * @param ApprovalActionType $actionType
     * @param string|null $notes
     * @return ApprovalAction
     */
    protected function recordSystemAction(ApprovalRequest $approvalRequest, ApprovalStep $step, ApprovalActionType $actionType, ?string $notes): ApprovalAction
    {
        return $this->recordAction($approvalRequest, $step, null, $actionType, $notes);
    }

    /**
     * Checks if the given employee is authorized to approve the current step of the request.
     * This method requires a robust permissions system (roles, direct assignment).
     *
     * @param ApprovalRequest $approvalRequest
     * @param Employee $employee
     * @return bool
     */
    public function isApproverAuthorized(ApprovalRequest $approvalRequest, Employee $employee): bool
    {
        $currentStep = $approvalRequest->workflow->steps->firstWhere('step_order', $approvalRequest->current_step);

        if (!$currentStep) {
            return false; // No current step or workflow completed
        }

        $possibleApprovers = $this->resolveApproversForStep($currentStep, $approvalRequest->requester, $approvalRequest->requestable);

        return $possibleApprovers->contains('id', $employee->id);
    }

    /**
     * Cancels an approval request.
     *
     * @param ApprovalRequest $approvalRequest
     * @param Employee $canceller
     * @param string|null $notes
     * @return ApprovalRequest
     * @throws \Exception If the request is already completed.
     */
    public function cancelRequest(ApprovalRequest $approvalRequest, Employee $canceller, ?string $notes = null): ApprovalRequest
    {
        if ($approvalRequest->status === ApprovalStatus::Approved || $approvalRequest->status === ApprovalStatus::Rejected) {
            throw new \Exception('Cannot cancel a completed approval request.');
        }

        return DB::transaction(function () use ($approvalRequest, $canceller, $notes) {
            $currentStep = $approvalRequest->workflow->steps->firstWhere('step_order', $approvalRequest->current_step);
            $this->recordAction($approvalRequest, $currentStep, $canceller, ApprovalActionType::Cancel, $notes ?? 'Request cancelled by requester.');

            $approvalRequest->status = ApprovalStatus::Cancelled;
            $approvalRequest->completed_at = now();
            $approvalRequest->save();

            // TODO: Dispatch ApprovalCancelled event
            // event(new ApprovalCancelled($approvalRequest));

            return $approvalRequest;
        });
    }

    /**
     * Escalate an approval request to a higher authority or the next step's approver.
     * This method could be triggered manually or by a scheduled job after a timeout.
     *
     * @param ApprovalRequest $approvalRequest
     * @param Employee|null $escalator The employee escalating, or null if system escalation.
     * @param string|null $notes
     * @return ApprovalRequest
     * @throws \Exception If the request is already completed or cannot be escalated.
     */
    public function escalateRequest(ApprovalRequest $approvalRequest, ?Employee $escalator = null, ?string $notes = null): ApprovalRequest
    {
        if ($approvalRequest->status === ApprovalStatus::Approved || $approvalRequest->status === ApprovalStatus::Rejected) {
            throw new \Exception('Cannot escalate a completed approval request.');
        }

        return DB::transaction(function () use ($approvalRequest, $escalator, $notes) {
            $currentStep = $approvalRequest->workflow->steps->firstWhere('step_order', $approvalRequest->current_step);
            $this->recordAction($approvalRequest, $currentStep, $escalator, ApprovalActionType::Escalate, $notes ?? 'Request escalated.');

            // For now, escalation means moving to the next step immediately.
            // More complex logic might involve finding specific alternate approvers.
            $approvalRequest->current_step++;
            $approvalRequest->save();

            // Automatically advance to the next step (which might resolve to a new approver)
            return $this->advanceToNextStep($approvalRequest);

            // TODO: Dispatch ApprovalEscalated event
            // event(new ApprovalEscalated($approvalRequest));
        });
    }

    /**
     * Allows an approver to request changes to a submitted request.
     * This typically reverts the request to a 'pending changes' state and notifies the requester.
     *
     * @param ApprovalRequest $approvalRequest
     * @param Employee $approver
     * @param string $notes
     * @return ApprovalRequest
     * @throws \Exception If the approver is not authorized or request is completed.
     */
    public function requestChanges(ApprovalRequest $approvalRequest, Employee $approver, string $notes): ApprovalRequest
    {
        if (!$this->isApproverAuthorized($approvalRequest, $approver)) {
            throw new \Exception('Approver not authorized for this step.');
        }
        if ($approvalRequest->status === ApprovalStatus::Approved || $approvalRequest->status === ApprovalStatus::Rejected) {
            throw new \Exception('Cannot request changes on a completed approval request.');
        }

        return DB::transaction(function () use ($approvalRequest, $approver, $notes) {
            $currentStep = $approvalRequest->workflow->steps->firstWhere('step_order', $approvalRequest->current_step);
            $this->recordAction($approvalRequest, $currentStep, $approver, ApprovalActionType::RequestChanges, $notes);

            // Set status to pending and reset current_step to 1 or a specific step for changes
            // For simplicity, let's revert to step 1 for requester to resubmit.
            $approvalRequest->status = ApprovalStatus::Pending; // Or a new `PendingChanges` status
            $approvalRequest->current_step = 1;
            $approvalRequest->save();

            // TODO: Notify requester for changes needed
            // event(new ApprovalChangesRequested($approvalRequest, $notes));

            return $approvalRequest;
        });
    }
}
