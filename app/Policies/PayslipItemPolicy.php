<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PayslipItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayslipItemPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PayslipItem');
    }

    public function view(AuthUser $authUser, PayslipItem $payslipItem): bool
    {
        return $authUser->can('View:PayslipItem');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PayslipItem');
    }

    public function update(AuthUser $authUser, PayslipItem $payslipItem): bool
    {
        return $authUser->can('Update:PayslipItem');
    }

    public function delete(AuthUser $authUser, PayslipItem $payslipItem): bool
    {
        return $authUser->can('Delete:PayslipItem');
    }

    public function restore(AuthUser $authUser, PayslipItem $payslipItem): bool
    {
        return $authUser->can('Restore:PayslipItem');
    }

    public function forceDelete(AuthUser $authUser, PayslipItem $payslipItem): bool
    {
        return $authUser->can('ForceDelete:PayslipItem');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PayslipItem');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PayslipItem');
    }

    public function replicate(AuthUser $authUser, PayslipItem $payslipItem): bool
    {
        return $authUser->can('Replicate:PayslipItem');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PayslipItem');
    }

}