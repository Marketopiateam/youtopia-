<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DepartmentGoal;
use Illuminate\Auth\Access\HandlesAuthorization;

class DepartmentGoalPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DepartmentGoal');
    }

    public function view(AuthUser $authUser, DepartmentGoal $departmentGoal): bool
    {
        return $authUser->can('View:DepartmentGoal');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DepartmentGoal');
    }

    public function update(AuthUser $authUser, DepartmentGoal $departmentGoal): bool
    {
        return $authUser->can('Update:DepartmentGoal');
    }

    public function delete(AuthUser $authUser, DepartmentGoal $departmentGoal): bool
    {
        return $authUser->can('Delete:DepartmentGoal');
    }

    public function restore(AuthUser $authUser, DepartmentGoal $departmentGoal): bool
    {
        return $authUser->can('Restore:DepartmentGoal');
    }

    public function forceDelete(AuthUser $authUser, DepartmentGoal $departmentGoal): bool
    {
        return $authUser->can('ForceDelete:DepartmentGoal');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DepartmentGoal');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DepartmentGoal');
    }

    public function replicate(AuthUser $authUser, DepartmentGoal $departmentGoal): bool
    {
        return $authUser->can('Replicate:DepartmentGoal');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DepartmentGoal');
    }

}