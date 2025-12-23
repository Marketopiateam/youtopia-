<?php

namespace App\Policies;

use App\Models\CompanyGoal;
use App\Models\User;

class CompanyGoalPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, CompanyGoal $goal): bool
    {
        if ($user->hasAnyRole(['super_admin', 'admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('manager')) {
            return $goal->owner?->manager_employee_id === $user->employee?->id;
        }

        if ($user->hasRole('employee')) {
            return $goal->owner_employee_id === $user->employee?->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr', 'manager', 'employee']);
    }

    public function update(User $user, CompanyGoal $goal): bool
    {
        if ($user->hasAnyRole(['super_admin', 'admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('manager')) {
            return $goal->owner?->manager_employee_id === $user->employee?->id;
        }

        return $goal->owner_employee_id === $user->employee?->id;
    }

    public function delete(User $user, CompanyGoal $goal): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin']);
    }
}
