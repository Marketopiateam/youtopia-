<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SalaryHistory;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalaryHistoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SalaryHistory');
    }

    public function view(AuthUser $authUser, SalaryHistory $salaryHistory): bool
    {
        return $authUser->can('View:SalaryHistory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SalaryHistory');
    }

    public function update(AuthUser $authUser, SalaryHistory $salaryHistory): bool
    {
        return $authUser->can('Update:SalaryHistory');
    }

    public function delete(AuthUser $authUser, SalaryHistory $salaryHistory): bool
    {
        return $authUser->can('Delete:SalaryHistory');
    }

    public function restore(AuthUser $authUser, SalaryHistory $salaryHistory): bool
    {
        return $authUser->can('Restore:SalaryHistory');
    }

    public function forceDelete(AuthUser $authUser, SalaryHistory $salaryHistory): bool
    {
        return $authUser->can('ForceDelete:SalaryHistory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SalaryHistory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SalaryHistory');
    }

    public function replicate(AuthUser $authUser, SalaryHistory $salaryHistory): bool
    {
        return $authUser->can('Replicate:SalaryHistory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SalaryHistory');
    }

}