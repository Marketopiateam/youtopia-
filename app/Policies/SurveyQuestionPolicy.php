<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SurveyQuestion;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyQuestionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SurveyQuestion');
    }

    public function view(AuthUser $authUser, SurveyQuestion $surveyQuestion): bool
    {
        return $authUser->can('View:SurveyQuestion');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SurveyQuestion');
    }

    public function update(AuthUser $authUser, SurveyQuestion $surveyQuestion): bool
    {
        return $authUser->can('Update:SurveyQuestion');
    }

    public function delete(AuthUser $authUser, SurveyQuestion $surveyQuestion): bool
    {
        return $authUser->can('Delete:SurveyQuestion');
    }

    public function restore(AuthUser $authUser, SurveyQuestion $surveyQuestion): bool
    {
        return $authUser->can('Restore:SurveyQuestion');
    }

    public function forceDelete(AuthUser $authUser, SurveyQuestion $surveyQuestion): bool
    {
        return $authUser->can('ForceDelete:SurveyQuestion');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SurveyQuestion');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SurveyQuestion');
    }

    public function replicate(AuthUser $authUser, SurveyQuestion $surveyQuestion): bool
    {
        return $authUser->can('Replicate:SurveyQuestion');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SurveyQuestion');
    }

}