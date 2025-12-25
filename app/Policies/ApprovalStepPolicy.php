<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ApprovalStep;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApprovalStepPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ApprovalStep');
    }

    public function view(AuthUser $authUser, ApprovalStep $approvalStep): bool
    {
        return $authUser->can('View:ApprovalStep');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ApprovalStep');
    }

    public function update(AuthUser $authUser, ApprovalStep $approvalStep): bool
    {
        return $authUser->can('Update:ApprovalStep');
    }

    public function delete(AuthUser $authUser, ApprovalStep $approvalStep): bool
    {
        return $authUser->can('Delete:ApprovalStep');
    }

    public function restore(AuthUser $authUser, ApprovalStep $approvalStep): bool
    {
        return $authUser->can('Restore:ApprovalStep');
    }

    public function forceDelete(AuthUser $authUser, ApprovalStep $approvalStep): bool
    {
        return $authUser->can('ForceDelete:ApprovalStep');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ApprovalStep');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ApprovalStep');
    }

    public function replicate(AuthUser $authUser, ApprovalStep $approvalStep): bool
    {
        return $authUser->can('Replicate:ApprovalStep');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ApprovalStep');
    }

}