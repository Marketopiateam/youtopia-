<?php

namespace Database\Seeders;

use App\Enums\OKRScope;
use App\Models\Department;
use App\Models\Employee;
use App\Models\OkrCycle;
use App\Models\OkrObjective;
use Illuminate\Database\Seeder;

class OkrObjectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (OkrCycle::count() === 0) {
            $this->call(OkrCycleSeeder::class);
        }
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }
        if (Department::count() === 0) {
            $this->call(DepartmentSeeder::class);
        }

        $okrCycles = OkrCycle::all();
        $employees = Employee::all();
        $departments = Department::all();
        $faker = \Faker\Factory::create();

        foreach ($okrCycles as $cycle) {
            for ($i = 0; $i < rand(3, 7); $i++) {
                $scope = $faker->randomElement(OKRScope::cases());
                $scopeId = null;

                if ($scope === OKRScope::Department && $departments->isNotEmpty()) {
                    $scopeId = $departments->random()->id;
                } elseif ($scope === OKRScope::Employee && $employees->isNotEmpty()) {
                    $scopeId = $employees->random()->id;
                }

                OkrObjective::factory()->create([
                    'cycle_id' => $cycle->id,
                    'scope' => $scope,
                    'scope_id' => $scopeId,
                    'owner_employee_id' => $employees->random()->id,
                ]);
            }
        }

        $this->command->info('OKR Objectives seeded.');
    }
}
