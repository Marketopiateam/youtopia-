<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OkrCheckin;
use Illuminate\Auth\Access\HandlesAuthorization;

class OkrCheckinPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OkrCheckin');
    }

    public function view(AuthUser $authUser, OkrCheckin $okrCheckin): bool
    {
        return $authUser->can('View:OkrCheckin');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OkrCheckin');
    }

    public function update(AuthUser $authUser, OkrCheckin $okrCheckin): bool
    {
        return $authUser->can('Update:OkrCheckin');
    }

    public function delete(AuthUser $authUser, OkrCheckin $okrCheckin): bool
    {
        return $authUser->can('Delete:OkrCheckin');
    }

    public function restore(AuthUser $authUser, OkrCheckin $okrCheckin): bool
    {
        return $authUser->can('Restore:OkrCheckin');
    }

    public function forceDelete(AuthUser $authUser, OkrCheckin $okrCheckin): bool
    {
        return $authUser->can('ForceDelete:OkrCheckin');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OkrCheckin');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OkrCheckin');
    }

    public function replicate(AuthUser $authUser, OkrCheckin $okrCheckin): bool
    {
        return $authUser->can('Replicate:OkrCheckin');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OkrCheckin');
    }

}