<?php

namespace App\Policies;

use App\Models\AttendanceLog;
use App\Models\User;

class AttendanceLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr', 'manager', 'employee']);
    }

    public function view(User $user, AttendanceLog $log): bool
    {
        if ($user->hasAnyRole(['super_admin', 'admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('manager')) {
            return $log->employee?->manager_employee_id === $user->employee?->id;
        }

        if ($user->hasRole('employee')) {
            return $log->employee_id === $user->employee?->id;
        }

        return false;
    }

    public function create(User $user): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr', 'employee']);
    }

    public function update(User $user, AttendanceLog $log): bool
    {
        if ($user->hasAnyRole(['super_admin', 'admin', 'hr'])) {
            return true;
        }

        if ($user->hasRole('employee')) {
            return $log->employee_id === $user->employee?->id
                && $log->created_at?->isToday();
        }

        return false;
    }

    public function delete(User $user, AttendanceLog $log): bool
    {
        return $user->hasAnyRole(['super_admin', 'admin', 'hr']);
    }
}
