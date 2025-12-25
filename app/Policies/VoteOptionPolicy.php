<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\VoteOption;
use Illuminate\Auth\Access\HandlesAuthorization;

class VoteOptionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:VoteOption');
    }

    public function view(AuthUser $authUser, VoteOption $voteOption): bool
    {
        return $authUser->can('View:VoteOption');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:VoteOption');
    }

    public function update(AuthUser $authUser, VoteOption $voteOption): bool
    {
        return $authUser->can('Update:VoteOption');
    }

    public function delete(AuthUser $authUser, VoteOption $voteOption): bool
    {
        return $authUser->can('Delete:VoteOption');
    }

    public function restore(AuthUser $authUser, VoteOption $voteOption): bool
    {
        return $authUser->can('Restore:VoteOption');
    }

    public function forceDelete(AuthUser $authUser, VoteOption $voteOption): bool
    {
        return $authUser->can('ForceDelete:VoteOption');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:VoteOption');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:VoteOption');
    }

    public function replicate(AuthUser $authUser, VoteOption $voteOption): bool
    {
        return $authUser->can('Replicate:VoteOption');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:VoteOption');
    }

}