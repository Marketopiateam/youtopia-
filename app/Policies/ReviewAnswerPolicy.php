<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ReviewAnswer;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewAnswerPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ReviewAnswer');
    }

    public function view(AuthUser $authUser, ReviewAnswer $reviewAnswer): bool
    {
        return $authUser->can('View:ReviewAnswer');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ReviewAnswer');
    }

    public function update(AuthUser $authUser, ReviewAnswer $reviewAnswer): bool
    {
        return $authUser->can('Update:ReviewAnswer');
    }

    public function delete(AuthUser $authUser, ReviewAnswer $reviewAnswer): bool
    {
        return $authUser->can('Delete:ReviewAnswer');
    }

    public function restore(AuthUser $authUser, ReviewAnswer $reviewAnswer): bool
    {
        return $authUser->can('Restore:ReviewAnswer');
    }

    public function forceDelete(AuthUser $authUser, ReviewAnswer $reviewAnswer): bool
    {
        return $authUser->can('ForceDelete:ReviewAnswer');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ReviewAnswer');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ReviewAnswer');
    }

    public function replicate(AuthUser $authUser, ReviewAnswer $reviewAnswer): bool
    {
        return $authUser->can('Replicate:ReviewAnswer');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ReviewAnswer');
    }

}