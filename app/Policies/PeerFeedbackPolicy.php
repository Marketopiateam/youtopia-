<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PeerFeedback;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeerFeedbackPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PeerFeedback');
    }

    public function view(AuthUser $authUser, PeerFeedback $peerFeedback): bool
    {
        return $authUser->can('View:PeerFeedback');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PeerFeedback');
    }

    public function update(AuthUser $authUser, PeerFeedback $peerFeedback): bool
    {
        return $authUser->can('Update:PeerFeedback');
    }

    public function delete(AuthUser $authUser, PeerFeedback $peerFeedback): bool
    {
        return $authUser->can('Delete:PeerFeedback');
    }

    public function restore(AuthUser $authUser, PeerFeedback $peerFeedback): bool
    {
        return $authUser->can('Restore:PeerFeedback');
    }

    public function forceDelete(AuthUser $authUser, PeerFeedback $peerFeedback): bool
    {
        return $authUser->can('ForceDelete:PeerFeedback');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PeerFeedback');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PeerFeedback');
    }

    public function replicate(AuthUser $authUser, PeerFeedback $peerFeedback): bool
    {
        return $authUser->can('Replicate:PeerFeedback');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PeerFeedback');
    }

}