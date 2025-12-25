<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::firstOrCreate(
            ['name' => 'Annual Leave'],
            ['code' => 'LT-ANNUAL', 'days_per_year' => 20, 'is_paid' => true, 'requires_approval' => true, 'is_active' => true]
        );
        LeaveType::firstOrCreate(
            ['name' => 'Sick Leave'],
            ['code' => 'LT-SICK', 'days_per_year' => 10, 'is_paid' => true, 'requires_approval' => true, 'is_active' => true]
        );
        LeaveType::firstOrCreate(
            ['name' => 'Maternity Leave'],
            ['code' => 'LT-MAT', 'days_per_year' => 90, 'is_paid' => true, 'requires_approval' => true, 'is_active' => true]
        );
        LeaveType::firstOrCreate(
            ['name' => 'Unpaid Leave'],
            ['code' => 'LT-UNPAID', 'days_per_year' => 365, 'is_paid' => false, 'requires_approval' => true, 'is_active' => true]
        );

        for ($i = 1; $i <= 3; $i++) {
            LeaveType::firstOrCreate(
                ['name' => "Custom Leave {$i}"],
                ['code' => "LT-CUSTOM-{$i}", 'days_per_year' => 15, 'is_paid' => true, 'requires_approval' => true, 'is_active' => true]
            );
        }

        $this->command->info('Leave Types seeded.');
    }
}
