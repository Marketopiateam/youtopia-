<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OnboardingTask;
use Illuminate\Auth\Access\HandlesAuthorization;

class OnboardingTaskPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OnboardingTask');
    }

    public function view(AuthUser $authUser, OnboardingTask $onboardingTask): bool
    {
        return $authUser->can('View:OnboardingTask');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OnboardingTask');
    }

    public function update(AuthUser $authUser, OnboardingTask $onboardingTask): bool
    {
        return $authUser->can('Update:OnboardingTask');
    }

    public function delete(AuthUser $authUser, OnboardingTask $onboardingTask): bool
    {
        return $authUser->can('Delete:OnboardingTask');
    }

    public function restore(AuthUser $authUser, OnboardingTask $onboardingTask): bool
    {
        return $authUser->can('Restore:OnboardingTask');
    }

    public function forceDelete(AuthUser $authUser, OnboardingTask $onboardingTask): bool
    {
        return $authUser->can('ForceDelete:OnboardingTask');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OnboardingTask');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OnboardingTask');
    }

    public function replicate(AuthUser $authUser, OnboardingTask $onboardingTask): bool
    {
        return $authUser->can('Replicate:OnboardingTask');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OnboardingTask');
    }

}