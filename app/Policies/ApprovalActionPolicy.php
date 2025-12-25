<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ApprovalAction;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApprovalActionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ApprovalAction');
    }

    public function view(AuthUser $authUser, ApprovalAction $approvalAction): bool
    {
        return $authUser->can('View:ApprovalAction');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ApprovalAction');
    }

    public function update(AuthUser $authUser, ApprovalAction $approvalAction): bool
    {
        return $authUser->can('Update:ApprovalAction');
    }

    public function delete(AuthUser $authUser, ApprovalAction $approvalAction): bool
    {
        return $authUser->can('Delete:ApprovalAction');
    }

    public function restore(AuthUser $authUser, ApprovalAction $approvalAction): bool
    {
        return $authUser->can('Restore:ApprovalAction');
    }

    public function forceDelete(AuthUser $authUser, ApprovalAction $approvalAction): bool
    {
        return $authUser->can('ForceDelete:ApprovalAction');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ApprovalAction');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ApprovalAction');
    }

    public function replicate(AuthUser $authUser, ApprovalAction $approvalAction): bool
    {
        return $authUser->can('Replicate:ApprovalAction');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ApprovalAction');
    }

}