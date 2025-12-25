<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ConversationParticipant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationParticipantPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ConversationParticipant');
    }

    public function view(AuthUser $authUser, ConversationParticipant $conversationParticipant): bool
    {
        return $authUser->can('View:ConversationParticipant');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ConversationParticipant');
    }

    public function update(AuthUser $authUser, ConversationParticipant $conversationParticipant): bool
    {
        return $authUser->can('Update:ConversationParticipant');
    }

    public function delete(AuthUser $authUser, ConversationParticipant $conversationParticipant): bool
    {
        return $authUser->can('Delete:ConversationParticipant');
    }

    public function restore(AuthUser $authUser, ConversationParticipant $conversationParticipant): bool
    {
        return $authUser->can('Restore:ConversationParticipant');
    }

    public function forceDelete(AuthUser $authUser, ConversationParticipant $conversationParticipant): bool
    {
        return $authUser->can('ForceDelete:ConversationParticipant');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ConversationParticipant');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ConversationParticipant');
    }

    public function replicate(AuthUser $authUser, ConversationParticipant $conversationParticipant): bool
    {
        return $authUser->can('Replicate:ConversationParticipant');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ConversationParticipant');
    }

}