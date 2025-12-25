<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\VoteBallot;
use Illuminate\Auth\Access\HandlesAuthorization;

class VoteBallotPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:VoteBallot');
    }

    public function view(AuthUser $authUser, VoteBallot $voteBallot): bool
    {
        return $authUser->can('View:VoteBallot');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:VoteBallot');
    }

    public function update(AuthUser $authUser, VoteBallot $voteBallot): bool
    {
        return $authUser->can('Update:VoteBallot');
    }

    public function delete(AuthUser $authUser, VoteBallot $voteBallot): bool
    {
        return $authUser->can('Delete:VoteBallot');
    }

    public function restore(AuthUser $authUser, VoteBallot $voteBallot): bool
    {
        return $authUser->can('Restore:VoteBallot');
    }

    public function forceDelete(AuthUser $authUser, VoteBallot $voteBallot): bool
    {
        return $authUser->can('ForceDelete:VoteBallot');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:VoteBallot');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:VoteBallot');
    }

    public function replicate(AuthUser $authUser, VoteBallot $voteBallot): bool
    {
        return $authUser->can('Replicate:VoteBallot');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:VoteBallot');
    }

}