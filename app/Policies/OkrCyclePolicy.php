<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OkrCycle;
use Illuminate\Auth\Access\HandlesAuthorization;

class OkrCyclePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OkrCycle');
    }

    public function view(AuthUser $authUser, OkrCycle $okrCycle): bool
    {
        return $authUser->can('View:OkrCycle');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OkrCycle');
    }

    public function update(AuthUser $authUser, OkrCycle $okrCycle): bool
    {
        return $authUser->can('Update:OkrCycle');
    }

    public function delete(AuthUser $authUser, OkrCycle $okrCycle): bool
    {
        return $authUser->can('Delete:OkrCycle');
    }

    public function restore(AuthUser $authUser, OkrCycle $okrCycle): bool
    {
        return $authUser->can('Restore:OkrCycle');
    }

    public function forceDelete(AuthUser $authUser, OkrCycle $okrCycle): bool
    {
        return $authUser->can('ForceDelete:OkrCycle');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OkrCycle');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OkrCycle');
    }

    public function replicate(AuthUser $authUser, OkrCycle $okrCycle): bool
    {
        return $authUser->can('Replicate:OkrCycle');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OkrCycle');
    }

}