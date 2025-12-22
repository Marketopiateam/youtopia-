<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'code' => 'VAC',
                'name' => 'Vacation',
                'is_active' => true,
                'needs_dates' => true,
                'needs_amount' => false,
                'allow_attachments' => true,
            ],
            [
                'code' => 'LEAVE',
                'name' => 'Leave Early',
                'is_active' => true,
                'needs_dates' => true,
                'needs_amount' => false,
                'allow_attachments' => false,
            ],
            [
                'code' => 'RESIGN',
                'name' => 'Resignation',
                'is_active' => true,
                'needs_dates' => false,
                'needs_amount' => false,
                'allow_attachments' => true,
            ],
            [
                'code' => 'ADV',
                'name' => 'Advance (Salary)',
                'is_active' => true,
                'needs_dates' => false,
                'needs_amount' => true,
                'allow_attachments' => true,
            ],
        ];

        foreach ($types as $type) {
            TicketType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
