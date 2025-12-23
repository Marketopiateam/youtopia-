<?php

namespace App\Policies;

use App\Models\JobPost;
use App\Models\User;

class JobPostPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, JobPost $jobPost): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr']);
    }

    public function update(User $user, JobPost $jobPost): bool
    {
        if ($user->hasAnyRole(['super_admin', 'admin'])) {
            return true;
        }

        if ($user->hasRole('hr')) {
            return $jobPost->created_by_employee_id === $user->employee?->id;
        }

        return false;
    }

    public function delete(User $user, JobPost $jobPost): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin']);
    }

    public function restore(User $user, JobPost $jobPost): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin']);
    }

    public function forceDelete(User $user, JobPost $jobPost): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin']);
    }
}
