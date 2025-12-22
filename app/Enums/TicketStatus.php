<?php

namespace App\Enums;

enum TicketStatus: string
{
    case PendingManager = 'pending_manager';
    case PendingHr = 'pending_hr';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
