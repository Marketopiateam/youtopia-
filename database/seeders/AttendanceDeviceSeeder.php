<?php

namespace Database\Seeders;

use App\Models\AttendanceDevice;
use Illuminate\Database\Seeder;

class AttendanceDeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttendanceDevice::create([
            'name' => 'Main Entrance Device',
            'location' => 'Building A, 1st Floor',
            'device_id' => 'ZKT-001',
            'is_active' => true,
        ]);

        AttendanceDevice::create([
            'name' => 'Lab Attendance Device',
            'location' => 'Building B, 3rd Floor',
            'device_id' => 'ZKT-002',
            'is_active' => true,
        ]);
    }
}
