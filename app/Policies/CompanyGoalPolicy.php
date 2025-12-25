<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CompanyGoal;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyGoalPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CompanyGoal');
    }

    public function view(AuthUser $authUser, CompanyGoal $companyGoal): bool
    {
        return $authUser->can('View:CompanyGoal');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CompanyGoal');
    }

    public function update(AuthUser $authUser, CompanyGoal $companyGoal): bool
    {
        return $authUser->can('Update:CompanyGoal');
    }

    public function delete(AuthUser $authUser, CompanyGoal $companyGoal): bool
    {
        return $authUser->can('Delete:CompanyGoal');
    }

    public function restore(AuthUser $authUser, CompanyGoal $companyGoal): bool
    {
        return $authUser->can('Restore:CompanyGoal');
    }

    public function forceDelete(AuthUser $authUser, CompanyGoal $companyGoal): bool
    {
        return $authUser->can('ForceDelete:CompanyGoal');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CompanyGoal');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CompanyGoal');
    }

    public function replicate(AuthUser $authUser, CompanyGoal $companyGoal): bool
    {
        return $authUser->can('Replicate:CompanyGoal');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CompanyGoal');
    }

}