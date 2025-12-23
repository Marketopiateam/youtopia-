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
        LeaveType::create([
            'name' => 'Annual Leave',
            'code' => 'AL',
            'days_per_year' => 20,
            'requires_approval' => true,
            'is_paid' => true,
        ]);

        LeaveType::create([
            'name' => 'Sick Leave',
            'code' => 'SL',
            'days_per_year' => 10,
            'requires_approval' => true,
            'is_paid' => true,
        ]);

        LeaveType::create([
            'name' => 'Unpaid Leave',
            'code' => 'UL',
            'days_per_year' => 0,
            'requires_approval' => true,
            'is_paid' => false,
        ]);
    }
}