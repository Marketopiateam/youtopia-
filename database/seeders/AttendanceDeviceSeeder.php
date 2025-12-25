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
        AttendanceDevice::firstOrCreate(
            ['name' => 'Main Office Entrance'],
            ['device_id' => 'DEV-00001', 'location' => 'Main Office - Ground Floor', 'is_active' => true]
        );
        AttendanceDevice::firstOrCreate(
            ['name' => 'HR Department Door'],
            ['device_id' => 'DEV-00002', 'location' => 'Main Office - 1st Floor HR', 'is_active' => true]
        );

        AttendanceDevice::factory()->count(5)->create();

        $this->command->info('Attendance Devices seeded.');
    }
}
