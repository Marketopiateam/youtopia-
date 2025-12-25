<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorklifeLike;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorklifeLikePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorklifeLike');
    }

    public function view(AuthUser $authUser, WorklifeLike $worklifeLike): bool
    {
        return $authUser->can('View:WorklifeLike');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorklifeLike');
    }

    public function update(AuthUser $authUser, WorklifeLike $worklifeLike): bool
    {
        return $authUser->can('Update:WorklifeLike');
    }

    public function delete(AuthUser $authUser, WorklifeLike $worklifeLike): bool
    {
        return $authUser->can('Delete:WorklifeLike');
    }

    public function restore(AuthUser $authUser, WorklifeLike $worklifeLike): bool
    {
        return $authUser->can('Restore:WorklifeLike');
    }

    public function forceDelete(AuthUser $authUser, WorklifeLike $worklifeLike): bool
    {
        return $authUser->can('ForceDelete:WorklifeLike');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorklifeLike');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorklifeLike');
    }

    public function replicate(AuthUser $authUser, WorklifeLike $worklifeLike): bool
    {
        return $authUser->can('Replicate:WorklifeLike');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorklifeLike');
    }

}