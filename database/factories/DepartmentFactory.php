<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    public function definition(): array
    {
        return [
            'parent_id' => null,
            'name' => $this->faker->companySuffix . ' Department',
            'code' => strtoupper($this->faker->bothify('DEP-####')),
            'manager_employee_id' => null,
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
