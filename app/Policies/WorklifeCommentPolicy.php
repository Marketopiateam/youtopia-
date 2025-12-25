<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorklifeComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorklifeCommentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorklifeComment');
    }

    public function view(AuthUser $authUser, WorklifeComment $worklifeComment): bool
    {
        return $authUser->can('View:WorklifeComment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorklifeComment');
    }

    public function update(AuthUser $authUser, WorklifeComment $worklifeComment): bool
    {
        return $authUser->can('Update:WorklifeComment');
    }

    public function delete(AuthUser $authUser, WorklifeComment $worklifeComment): bool
    {
        return $authUser->can('Delete:WorklifeComment');
    }

    public function restore(AuthUser $authUser, WorklifeComment $worklifeComment): bool
    {
        return $authUser->can('Restore:WorklifeComment');
    }

    public function forceDelete(AuthUser $authUser, WorklifeComment $worklifeComment): bool
    {
        return $authUser->can('ForceDelete:WorklifeComment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorklifeComment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorklifeComment');
    }

    public function replicate(AuthUser $authUser, WorklifeComment $worklifeComment): bool
    {
        return $authUser->can('Replicate:WorklifeComment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorklifeComment');
    }

}