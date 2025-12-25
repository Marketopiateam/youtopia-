<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\GoalLink;
use Illuminate\Auth\Access\HandlesAuthorization;

class GoalLinkPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:GoalLink');
    }

    public function view(AuthUser $authUser, GoalLink $goalLink): bool
    {
        return $authUser->can('View:GoalLink');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:GoalLink');
    }

    public function update(AuthUser $authUser, GoalLink $goalLink): bool
    {
        return $authUser->can('Update:GoalLink');
    }

    public function delete(AuthUser $authUser, GoalLink $goalLink): bool
    {
        return $authUser->can('Delete:GoalLink');
    }

    public function restore(AuthUser $authUser, GoalLink $goalLink): bool
    {
        return $authUser->can('Restore:GoalLink');
    }

    public function forceDelete(AuthUser $authUser, GoalLink $goalLink): bool
    {
        return $authUser->can('ForceDelete:GoalLink');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:GoalLink');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:GoalLink');
    }

    public function replicate(AuthUser $authUser, GoalLink $goalLink): bool
    {
        return $authUser->can('Replicate:GoalLink');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:GoalLink');
    }

}