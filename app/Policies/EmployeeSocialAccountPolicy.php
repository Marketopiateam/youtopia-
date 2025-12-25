<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\EmployeeSocialAccount;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeSocialAccountPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:EmployeeSocialAccount');
    }

    public function view(AuthUser $authUser, EmployeeSocialAccount $employeeSocialAccount): bool
    {
        return $authUser->can('View:EmployeeSocialAccount');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:EmployeeSocialAccount');
    }

    public function update(AuthUser $authUser, EmployeeSocialAccount $employeeSocialAccount): bool
    {
        return $authUser->can('Update:EmployeeSocialAccount');
    }

    public function delete(AuthUser $authUser, EmployeeSocialAccount $employeeSocialAccount): bool
    {
        return $authUser->can('Delete:EmployeeSocialAccount');
    }

    public function restore(AuthUser $authUser, EmployeeSocialAccount $employeeSocialAccount): bool
    {
        return $authUser->can('Restore:EmployeeSocialAccount');
    }

    public function forceDelete(AuthUser $authUser, EmployeeSocialAccount $employeeSocialAccount): bool
    {
        return $authUser->can('ForceDelete:EmployeeSocialAccount');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:EmployeeSocialAccount');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:EmployeeSocialAccount');
    }

    public function replicate(AuthUser $authUser, EmployeeSocialAccount $employeeSocialAccount): bool
    {
        return $authUser->can('Replicate:EmployeeSocialAccount');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:EmployeeSocialAccount');
    }

}