<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorklifeAttachment;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorklifeAttachmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorklifeAttachment');
    }

    public function view(AuthUser $authUser, WorklifeAttachment $worklifeAttachment): bool
    {
        return $authUser->can('View:WorklifeAttachment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorklifeAttachment');
    }

    public function update(AuthUser $authUser, WorklifeAttachment $worklifeAttachment): bool
    {
        return $authUser->can('Update:WorklifeAttachment');
    }

    public function delete(AuthUser $authUser, WorklifeAttachment $worklifeAttachment): bool
    {
        return $authUser->can('Delete:WorklifeAttachment');
    }

    public function restore(AuthUser $authUser, WorklifeAttachment $worklifeAttachment): bool
    {
        return $authUser->can('Restore:WorklifeAttachment');
    }

    public function forceDelete(AuthUser $authUser, WorklifeAttachment $worklifeAttachment): bool
    {
        return $authUser->can('ForceDelete:WorklifeAttachment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorklifeAttachment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorklifeAttachment');
    }

    public function replicate(AuthUser $authUser, WorklifeAttachment $worklifeAttachment): bool
    {
        return $authUser->can('Replicate:WorklifeAttachment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorklifeAttachment');
    }

}