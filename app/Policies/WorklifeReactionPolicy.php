<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\WorklifeReaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorklifeReactionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:WorklifeReaction');
    }

    public function view(AuthUser $authUser, WorklifeReaction $worklifeReaction): bool
    {
        return $authUser->can('View:WorklifeReaction');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:WorklifeReaction');
    }

    public function update(AuthUser $authUser, WorklifeReaction $worklifeReaction): bool
    {
        return $authUser->can('Update:WorklifeReaction');
    }

    public function delete(AuthUser $authUser, WorklifeReaction $worklifeReaction): bool
    {
        return $authUser->can('Delete:WorklifeReaction');
    }

    public function restore(AuthUser $authUser, WorklifeReaction $worklifeReaction): bool
    {
        return $authUser->can('Restore:WorklifeReaction');
    }

    public function forceDelete(AuthUser $authUser, WorklifeReaction $worklifeReaction): bool
    {
        return $authUser->can('ForceDelete:WorklifeReaction');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:WorklifeReaction');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:WorklifeReaction');
    }

    public function replicate(AuthUser $authUser, WorklifeReaction $worklifeReaction): bool
    {
        return $authUser->can('Replicate:WorklifeReaction');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:WorklifeReaction');
    }

}