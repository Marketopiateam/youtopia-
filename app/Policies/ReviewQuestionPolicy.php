<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ReviewQuestion;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewQuestionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ReviewQuestion');
    }

    public function view(AuthUser $authUser, ReviewQuestion $reviewQuestion): bool
    {
        return $authUser->can('View:ReviewQuestion');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ReviewQuestion');
    }

    public function update(AuthUser $authUser, ReviewQuestion $reviewQuestion): bool
    {
        return $authUser->can('Update:ReviewQuestion');
    }

    public function delete(AuthUser $authUser, ReviewQuestion $reviewQuestion): bool
    {
        return $authUser->can('Delete:ReviewQuestion');
    }

    public function restore(AuthUser $authUser, ReviewQuestion $reviewQuestion): bool
    {
        return $authUser->can('Restore:ReviewQuestion');
    }

    public function forceDelete(AuthUser $authUser, ReviewQuestion $reviewQuestion): bool
    {
        return $authUser->can('ForceDelete:ReviewQuestion');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ReviewQuestion');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ReviewQuestion');
    }

    public function replicate(AuthUser $authUser, ReviewQuestion $reviewQuestion): bool
    {
        return $authUser->can('Replicate:ReviewQuestion');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ReviewQuestion');
    }

}