<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SurveyQuestionOption;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyQuestionOptionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SurveyQuestionOption');
    }

    public function view(AuthUser $authUser, SurveyQuestionOption $surveyQuestionOption): bool
    {
        return $authUser->can('View:SurveyQuestionOption');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SurveyQuestionOption');
    }

    public function update(AuthUser $authUser, SurveyQuestionOption $surveyQuestionOption): bool
    {
        return $authUser->can('Update:SurveyQuestionOption');
    }

    public function delete(AuthUser $authUser, SurveyQuestionOption $surveyQuestionOption): bool
    {
        return $authUser->can('Delete:SurveyQuestionOption');
    }

    public function restore(AuthUser $authUser, SurveyQuestionOption $surveyQuestionOption): bool
    {
        return $authUser->can('Restore:SurveyQuestionOption');
    }

    public function forceDelete(AuthUser $authUser, SurveyQuestionOption $surveyQuestionOption): bool
    {
        return $authUser->can('ForceDelete:SurveyQuestionOption');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SurveyQuestionOption');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SurveyQuestionOption');
    }

    public function replicate(AuthUser $authUser, SurveyQuestionOption $surveyQuestionOption): bool
    {
        return $authUser->can('Replicate:SurveyQuestionOption');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SurveyQuestionOption');
    }

}