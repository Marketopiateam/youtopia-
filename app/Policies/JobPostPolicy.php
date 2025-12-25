<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\JobPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPostPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:JobPost');
    }

    public function view(AuthUser $authUser, JobPost $jobPost): bool
    {
        return $authUser->can('View:JobPost');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:JobPost');
    }

    public function update(AuthUser $authUser, JobPost $jobPost): bool
    {
        return $authUser->can('Update:JobPost');
    }

    public function delete(AuthUser $authUser, JobPost $jobPost): bool
    {
        return $authUser->can('Delete:JobPost');
    }

    public function restore(AuthUser $authUser, JobPost $jobPost): bool
    {
        return $authUser->can('Restore:JobPost');
    }

    public function forceDelete(AuthUser $authUser, JobPost $jobPost): bool
    {
        return $authUser->can('ForceDelete:JobPost');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:JobPost');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:JobPost');
    }

    public function replicate(AuthUser $authUser, JobPost $jobPost): bool
    {
        return $authUser->can('Replicate:JobPost');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:JobPost');
    }

}