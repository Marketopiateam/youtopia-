<?php

namespace Database\Factories;

use App\Models\AttendanceDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceDeviceFactory extends Factory
{
    protected $model = AttendanceDevice::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Attendance Device',
            'location' => $this->faker->address,
            'device_id' => strtoupper($this->faker->unique()->bothify('DEV-#####')),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
