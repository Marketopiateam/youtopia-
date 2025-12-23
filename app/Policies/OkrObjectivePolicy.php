<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OkrObjective;
use Illuminate\Auth\Access\HandlesAuthorization;

class OkrObjectivePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OkrObjective');
    }

    public function view(AuthUser $authUser, OkrObjective $okrObjective): bool
    {
        return $authUser->can('View:OkrObjective');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OkrObjective');
    }

    public function update(AuthUser $authUser, OkrObjective $okrObjective): bool
    {
        return $authUser->can('Update:OkrObjective');
    }

    public function delete(AuthUser $authUser, OkrObjective $okrObjective): bool
    {
        return $authUser->can('Delete:OkrObjective');
    }

    public function restore(AuthUser $authUser, OkrObjective $okrObjective): bool
    {
        return $authUser->can('Restore:OkrObjective');
    }

    public function forceDelete(AuthUser $authUser, OkrObjective $okrObjective): bool
    {
        return $authUser->can('ForceDelete:OkrObjective');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OkrObjective');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OkrObjective');
    }

    public function replicate(AuthUser $authUser, OkrObjective $okrObjective): bool
    {
        return $authUser->can('Replicate:OkrObjective');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OkrObjective');
    }

}