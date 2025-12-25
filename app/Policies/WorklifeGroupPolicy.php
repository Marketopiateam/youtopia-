<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorklifeGroup;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorklifeGroupPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorklifeGroup');
    }

    public function view(AuthUser $authUser, WorklifeGroup $worklifeGroup): bool
    {
        return $authUser->can('View:WorklifeGroup');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorklifeGroup');
    }

    public function update(AuthUser $authUser, WorklifeGroup $worklifeGroup): bool
    {
        return $authUser->can('Update:WorklifeGroup');
    }

    public function delete(AuthUser $authUser, WorklifeGroup $worklifeGroup): bool
    {
        return $authUser->can('Delete:WorklifeGroup');
    }

    public function restore(AuthUser $authUser, WorklifeGroup $worklifeGroup): bool
    {
        return $authUser->can('Restore:WorklifeGroup');
    }

    public function forceDelete(AuthUser $authUser, WorklifeGroup $worklifeGroup): bool
    {
        return $authUser->can('ForceDelete:WorklifeGroup');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorklifeGroup');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorklifeGroup');
    }

    public function replicate(AuthUser $authUser, WorklifeGroup $worklifeGroup): bool
    {
        return $authUser->can('Replicate:WorklifeGroup');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorklifeGroup');
    }

}