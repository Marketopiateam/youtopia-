<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ApprovalWorkflow;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApprovalWorkflowPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ApprovalWorkflow');
    }

    public function view(AuthUser $authUser, ApprovalWorkflow $approvalWorkflow): bool
    {
        return $authUser->can('View:ApprovalWorkflow');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ApprovalWorkflow');
    }

    public function update(AuthUser $authUser, ApprovalWorkflow $approvalWorkflow): bool
    {
        return $authUser->can('Update:ApprovalWorkflow');
    }

    public function delete(AuthUser $authUser, ApprovalWorkflow $approvalWorkflow): bool
    {
        return $authUser->can('Delete:ApprovalWorkflow');
    }

    public function restore(AuthUser $authUser, ApprovalWorkflow $approvalWorkflow): bool
    {
        return $authUser->can('Restore:ApprovalWorkflow');
    }

    public function forceDelete(AuthUser $authUser, ApprovalWorkflow $approvalWorkflow): bool
    {
        return $authUser->can('ForceDelete:ApprovalWorkflow');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ApprovalWorkflow');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ApprovalWorkflow');
    }

    public function replicate(AuthUser $authUser, ApprovalWorkflow $approvalWorkflow): bool
    {
        return $authUser->can('Replicate:ApprovalWorkflow');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ApprovalWorkflow');
    }

}