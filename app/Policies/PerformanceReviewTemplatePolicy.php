<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PerformanceReviewTemplate;
use Illuminate\Auth\Access\HandlesAuthorization;

class PerformanceReviewTemplatePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PerformanceReviewTemplate');
    }

    public function view(AuthUser $authUser, PerformanceReviewTemplate $performanceReviewTemplate): bool
    {
        return $authUser->can('View:PerformanceReviewTemplate');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PerformanceReviewTemplate');
    }

    public function update(AuthUser $authUser, PerformanceReviewTemplate $performanceReviewTemplate): bool
    {
        return $authUser->can('Update:PerformanceReviewTemplate');
    }

    public function delete(AuthUser $authUser, PerformanceReviewTemplate $performanceReviewTemplate): bool
    {
        return $authUser->can('Delete:PerformanceReviewTemplate');
    }

    public function restore(AuthUser $authUser, PerformanceReviewTemplate $performanceReviewTemplate): bool
    {
        return $authUser->can('Restore:PerformanceReviewTemplate');
    }

    public function forceDelete(AuthUser $authUser, PerformanceReviewTemplate $performanceReviewTemplate): bool
    {
        return $authUser->can('ForceDelete:PerformanceReviewTemplate');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PerformanceReviewTemplate');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PerformanceReviewTemplate');
    }

    public function replicate(AuthUser $authUser, PerformanceReviewTemplate $performanceReviewTemplate): bool
    {
        return $authUser->can('Replicate:PerformanceReviewTemplate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PerformanceReviewTemplate');
    }

}