<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorklifePost;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorklifePostPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorklifePost');
    }

    public function view(AuthUser $authUser, WorklifePost $worklifePost): bool
    {
        return $authUser->can('View:WorklifePost');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorklifePost');
    }

    public function update(AuthUser $authUser, WorklifePost $worklifePost): bool
    {
        return $authUser->can('Update:WorklifePost');
    }

    public function delete(AuthUser $authUser, WorklifePost $worklifePost): bool
    {
        return $authUser->can('Delete:WorklifePost');
    }

    public function restore(AuthUser $authUser, WorklifePost $worklifePost): bool
    {
        return $authUser->can('Restore:WorklifePost');
    }

    public function forceDelete(AuthUser $authUser, WorklifePost $worklifePost): bool
    {
        return $authUser->can('ForceDelete:WorklifePost');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorklifePost');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorklifePost');
    }

    public function replicate(AuthUser $authUser, WorklifePost $worklifePost): bool
    {
        return $authUser->can('Replicate:WorklifePost');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorklifePost');
    }

}