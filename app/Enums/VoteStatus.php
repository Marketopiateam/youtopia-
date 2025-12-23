<?php

namespace App\Enums;

enum VoteStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Closed = 'closed';
}