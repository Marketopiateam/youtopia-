<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\EmployeeDepartment;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeeDepartmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:EmployeeDepartment');
    }

    public function view(AuthUser $authUser, EmployeeDepartment $employeeDepartment): bool
    {
        return $authUser->can('View:EmployeeDepartment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:EmployeeDepartment');
    }

    public function update(AuthUser $authUser, EmployeeDepartment $employeeDepartment): bool
    {
        return $authUser->can('Update:EmployeeDepartment');
    }

    public function delete(AuthUser $authUser, EmployeeDepartment $employeeDepartment): bool
    {
        return $authUser->can('Delete:EmployeeDepartment');
    }

    public function restore(AuthUser $authUser, EmployeeDepartment $employeeDepartment): bool
    {
        return $authUser->can('Restore:EmployeeDepartment');
    }

    public function forceDelete(AuthUser $authUser, EmployeeDepartment $employeeDepartment): bool
    {
        return $authUser->can('ForceDelete:EmployeeDepartment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:EmployeeDepartment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:EmployeeDepartment');
    }

    public function replicate(AuthUser $authUser, EmployeeDepartment $employeeDepartment): bool
    {
        return $authUser->can('Replicate:EmployeeDepartment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:EmployeeDepartment');
    }

}