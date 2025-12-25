<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ApprovalRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApprovalRequestPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ApprovalRequest');
    }

    public function view(AuthUser $authUser, ApprovalRequest $approvalRequest): bool
    {
        return $authUser->can('View:ApprovalRequest');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ApprovalRequest');
    }

    public function update(AuthUser $authUser, ApprovalRequest $approvalRequest): bool
    {
        return $authUser->can('Update:ApprovalRequest');
    }

    public function delete(AuthUser $authUser, ApprovalRequest $approvalRequest): bool
    {
        return $authUser->can('Delete:ApprovalRequest');
    }

    public function restore(AuthUser $authUser, ApprovalRequest $approvalRequest): bool
    {
        return $authUser->can('Restore:ApprovalRequest');
    }

    public function forceDelete(AuthUser $authUser, ApprovalRequest $approvalRequest): bool
    {
        return $authUser->can('ForceDelete:ApprovalRequest');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ApprovalRequest');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ApprovalRequest');
    }

    public function replicate(AuthUser $authUser, ApprovalRequest $approvalRequest): bool
    {
        return $authUser->can('Replicate:ApprovalRequest');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ApprovalRequest');
    }

}