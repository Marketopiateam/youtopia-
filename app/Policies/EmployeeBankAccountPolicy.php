<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\EmployeeBankAccount;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeBankAccountPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:EmployeeBankAccount');
    }

    public function view(AuthUser $authUser, EmployeeBankAccount $employeeBankAccount): bool
    {
        return $authUser->can('View:EmployeeBankAccount');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:EmployeeBankAccount');
    }

    public function update(AuthUser $authUser, EmployeeBankAccount $employeeBankAccount): bool
    {
        return $authUser->can('Update:EmployeeBankAccount');
    }

    public function delete(AuthUser $authUser, EmployeeBankAccount $employeeBankAccount): bool
    {
        return $authUser->can('Delete:EmployeeBankAccount');
    }

    public function restore(AuthUser $authUser, EmployeeBankAccount $employeeBankAccount): bool
    {
        return $authUser->can('Restore:EmployeeBankAccount');
    }

    public function forceDelete(AuthUser $authUser, EmployeeBankAccount $employeeBankAccount): bool
    {
        return $authUser->can('ForceDelete:EmployeeBankAccount');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:EmployeeBankAccount');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:EmployeeBankAccount');
    }

    public function replicate(AuthUser $authUser, EmployeeBankAccount $employeeBankAccount): bool
    {
        return $authUser->can('Replicate:EmployeeBankAccount');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:EmployeeBankAccount');
    }

}