<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OfferLetter;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferLetterPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OfferLetter');
    }

    public function view(AuthUser $authUser, OfferLetter $offerLetter): bool
    {
        return $authUser->can('View:OfferLetter');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OfferLetter');
    }

    public function update(AuthUser $authUser, OfferLetter $offerLetter): bool
    {
        return $authUser->can('Update:OfferLetter');
    }

    public function delete(AuthUser $authUser, OfferLetter $offerLetter): bool
    {
        return $authUser->can('Delete:OfferLetter');
    }

    public function restore(AuthUser $authUser, OfferLetter $offerLetter): bool
    {
        return $authUser->can('Restore:OfferLetter');
    }

    public function forceDelete(AuthUser $authUser, OfferLetter $offerLetter): bool
    {
        return $authUser->can('ForceDelete:OfferLetter');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OfferLetter');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OfferLetter');
    }

    public function replicate(AuthUser $authUser, OfferLetter $offerLetter): bool
    {
        return $authUser->can('Replicate:OfferLetter');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OfferLetter');
    }

}