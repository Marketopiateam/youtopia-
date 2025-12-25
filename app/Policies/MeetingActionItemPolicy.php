<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MeetingActionItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingActionItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MeetingActionItem');
    }

    public function view(AuthUser $authUser, MeetingActionItem $meetingActionItem): bool
    {
        return $authUser->can('View:MeetingActionItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MeetingActionItem');
    }

    public function update(AuthUser $authUser, MeetingActionItem $meetingActionItem): bool
    {
        return $authUser->can('Update:MeetingActionItem');
    }

    public function delete(AuthUser $authUser, MeetingActionItem $meetingActionItem): bool
    {
        return $authUser->can('Delete:MeetingActionItem');
    }

    public function restore(AuthUser $authUser, MeetingActionItem $meetingActionItem): bool
    {
        return $authUser->can('Restore:MeetingActionItem');
    }

    public function forceDelete(AuthUser $authUser, MeetingActionItem $meetingActionItem): bool
    {
        return $authUser->can('ForceDelete:MeetingActionItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MeetingActionItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MeetingActionItem');
    }

    public function replicate(AuthUser $authUser, MeetingActionItem $meetingActionItem): bool
    {
        return $authUser->can('Replicate:MeetingActionItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MeetingActionItem');
    }

}