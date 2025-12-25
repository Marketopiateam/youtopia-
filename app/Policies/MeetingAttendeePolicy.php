<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MeetingAttendee;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingAttendeePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MeetingAttendee');
    }

    public function view(AuthUser $authUser, MeetingAttendee $meetingAttendee): bool
    {
        return $authUser->can('View:MeetingAttendee');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MeetingAttendee');
    }

    public function update(AuthUser $authUser, MeetingAttendee $meetingAttendee): bool
    {
        return $authUser->can('Update:MeetingAttendee');
    }

    public function delete(AuthUser $authUser, MeetingAttendee $meetingAttendee): bool
    {
        return $authUser->can('Delete:MeetingAttendee');
    }

    public function restore(AuthUser $authUser, MeetingAttendee $meetingAttendee): bool
    {
        return $authUser->can('Restore:MeetingAttendee');
    }

    public function forceDelete(AuthUser $authUser, MeetingAttendee $meetingAttendee): bool
    {
        return $authUser->can('ForceDelete:MeetingAttendee');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MeetingAttendee');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MeetingAttendee');
    }

    public function replicate(AuthUser $authUser, MeetingAttendee $meetingAttendee): bool
    {
        return $authUser->can('Replicate:MeetingAttendee');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MeetingAttendee');
    }

}