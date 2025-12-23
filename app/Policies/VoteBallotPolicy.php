<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VoteBallot;

class VoteBallotPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, VoteBallot $ballot): bool
    {
        if ($user->hasAnyRole(['super_admin', 'admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('manager')) {
            return $ballot->employee?->manager_employee_id === $user->employee?->id;
        }

        if ($user->hasRole('employee')) {
            return $ballot->employee_id === $user->employee?->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr', 'manager', 'employee']);
    }

    public function update(User $user, VoteBallot $ballot): bool
    {
        if ($user->hasAnyRole(['super_admin', 'admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('manager')) {
            return $ballot->employee?->manager_employee_id === $user->employee?->id;
        }

        return $ballot->employee_id === $user->employee?->id;
    }

    public function delete(User $user, VoteBallot $ballot): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin']);
    }
}
