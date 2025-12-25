<?php

namespace App\Enums;

enum ApprovalActionType: string
{
    case Approve = 'approve';
    case Reject = 'reject';
    case RequestChanges = 'request_changes';
    case Escalate = 'escalate';
    case Delegate = 'delegate';
    case AutoApproved = 'auto_approved'; // For steps that get automatically approved
    case Cancel = 'cancel'; // If the requester cancels the request
}
