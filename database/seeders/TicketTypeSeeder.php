<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketType::firstOrCreate(['name' => 'IT Support'], ['is_active' => true]);
        TicketType::firstOrCreate(['name' => 'HR Inquiry'], ['is_active' => true]);
        TicketType::firstOrCreate(['name' => 'Payroll Issue'], ['is_active' => true]);
        TicketType::firstOrCreate(['name' => 'Equipment Request'], ['is_active' => true]);
        TicketType::firstOrCreate(['name' => 'General Inquiry'], ['is_active' => true]);

        for ($i = 1; $i <= 3; $i++) {
            TicketType::firstOrCreate(
                ['name' => "Custom Ticket Type {$i}"],
                ['is_active' => true]
            );
        }

        $this->command->info('Ticket Types seeded.');
    }
}
