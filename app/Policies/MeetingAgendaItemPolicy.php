<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MeetingAgendaItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeetingAgendaItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MeetingAgendaItem');
    }

    public function view(AuthUser $authUser, MeetingAgendaItem $meetingAgendaItem): bool
    {
        return $authUser->can('View:MeetingAgendaItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MeetingAgendaItem');
    }

    public function update(AuthUser $authUser, MeetingAgendaItem $meetingAgendaItem): bool
    {
        return $authUser->can('Update:MeetingAgendaItem');
    }

    public function delete(AuthUser $authUser, MeetingAgendaItem $meetingAgendaItem): bool
    {
        return $authUser->can('Delete:MeetingAgendaItem');
    }

    public function restore(AuthUser $authUser, MeetingAgendaItem $meetingAgendaItem): bool
    {
        return $authUser->can('Restore:MeetingAgendaItem');
    }

    public function forceDelete(AuthUser $authUser, MeetingAgendaItem $meetingAgendaItem): bool
    {
        return $authUser->can('ForceDelete:MeetingAgendaItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MeetingAgendaItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MeetingAgendaItem');
    }

    public function replicate(AuthUser $authUser, MeetingAgendaItem $meetingAgendaItem): bool
    {
        return $authUser->can('Replicate:MeetingAgendaItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MeetingAgendaItem');
    }

}