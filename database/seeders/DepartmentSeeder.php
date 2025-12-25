<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::firstOrCreate(['name' => 'Human Resources'], ['code' => 'HR-001', 'is_active' => true]);
        Department::firstOrCreate(['name' => 'Finance'], ['code' => 'FIN-001', 'is_active' => true]);
        Department::firstOrCreate(['name' => 'Engineering'], ['code' => 'ENG-001', 'is_active' => true]);
        Department::firstOrCreate(['name' => 'Marketing'], ['code' => 'MKT-001', 'is_active' => true]);
        Department::firstOrCreate(['name' => 'Sales'], ['code' => 'SAL-001', 'is_active' => true]);
        Department::firstOrCreate(['name' => 'Customer Support'], ['code' => 'CS-001', 'is_active' => true]);

        Department::factory()->count(5)->create();

        $this->command->info('Departments seeded.');
    }
}
