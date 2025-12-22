<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $sales = Department::updateOrCreate(
            ['name' => 'Sales'],
            ['parent_id' => null, 'is_active' => true]
        );

        $ops = Department::updateOrCreate(
            ['name' => 'Operations'],
            ['parent_id' => null, 'is_active' => true]
        );

        Department::updateOrCreate(
            ['name' => 'Inside Sales'],
            ['parent_id' => $sales->id, 'is_active' => true]
        );

        Department::updateOrCreate(
            ['name' => 'Support'],
            ['parent_id' => $ops->id, 'is_active' => true]
        );
    }
}
