<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepository extends BaseRepository
{
    protected function model(): string
    {
        return Ticket::class;
    }
}
