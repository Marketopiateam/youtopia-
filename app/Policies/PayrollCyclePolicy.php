<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PayrollCycle;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayrollCyclePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PayrollCycle');
    }

    public function view(AuthUser $authUser, PayrollCycle $payrollCycle): bool
    {
        return $authUser->can('View:PayrollCycle');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PayrollCycle');
    }

    public function update(AuthUser $authUser, PayrollCycle $payrollCycle): bool
    {
        return $authUser->can('Update:PayrollCycle');
    }

    public function delete(AuthUser $authUser, PayrollCycle $payrollCycle): bool
    {
        return $authUser->can('Delete:PayrollCycle');
    }

    public function restore(AuthUser $authUser, PayrollCycle $payrollCycle): bool
    {
        return $authUser->can('Restore:PayrollCycle');
    }

    public function forceDelete(AuthUser $authUser, PayrollCycle $payrollCycle): bool
    {
        return $authUser->can('ForceDelete:PayrollCycle');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PayrollCycle');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PayrollCycle');
    }

    public function replicate(AuthUser $authUser, PayrollCycle $payrollCycle): bool
    {
        return $authUser->can('Replicate:PayrollCycle');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PayrollCycle');
    }

}