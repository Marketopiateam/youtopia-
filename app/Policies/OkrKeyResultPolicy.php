<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OkrKeyResult;
use Illuminate\Auth\Access\HandlesAuthorization;

class OkrKeyResultPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OkrKeyResult');
    }

    public function view(AuthUser $authUser, OkrKeyResult $okrKeyResult): bool
    {
        return $authUser->can('View:OkrKeyResult');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OkrKeyResult');
    }

    public function update(AuthUser $authUser, OkrKeyResult $okrKeyResult): bool
    {
        return $authUser->can('Update:OkrKeyResult');
    }

    public function delete(AuthUser $authUser, OkrKeyResult $okrKeyResult): bool
    {
        return $authUser->can('Delete:OkrKeyResult');
    }

    public function restore(AuthUser $authUser, OkrKeyResult $okrKeyResult): bool
    {
        return $authUser->can('Restore:OkrKeyResult');
    }

    public function forceDelete(AuthUser $authUser, OkrKeyResult $okrKeyResult): bool
    {
        return $authUser->can('ForceDelete:OkrKeyResult');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OkrKeyResult');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OkrKeyResult');
    }

    public function replicate(AuthUser $authUser, OkrKeyResult $okrKeyResult): bool
    {
        return $authUser->can('Replicate:OkrKeyResult');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OkrKeyResult');
    }

}