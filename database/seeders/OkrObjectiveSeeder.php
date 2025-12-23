<?php

namespace Database\Seeders;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
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
        $cycles = OkrCycle::all();
        $employees = Employee::all();
        $departments = Department::all();

        if ($cycles->isEmpty() || $employees->isEmpty()) {
            $this->command->info('No cycles or employees found, skipping OKR objective seeding.');
            return;
        }

        // Company Objective
        OkrObjective::create([
            'cycle_id' => $cycles->first()->id,
            'title' => 'Achieve Product-Market Fit',
            'scope' => OKRScope::Company,
            'owner_employee_id' => $employees->random()->id,
            'status' => OKRStatus::Active,
        ]);

        // Department Objective
        if ($departments->isNotEmpty()) {
            OkrObjective::create([
                'cycle_id' => $cycles->first()->id,
                'title' => 'Increase Engineering Velocity',
                'scope' => OKRScope::Department,
                'scope_id' => $departments->random()->id,
                'owner_employee_id' => $employees->random()->id,
                'status' => OKRStatus::Active,
            ]);
        }

        // Employee Objective
        OkrObjective::create([
            'cycle_id' => $cycles->first()->id,
            'title' => 'Master Laravel Livewire',
            'scope' => OKRScope::Employee,
            'scope_id' => $employees->random()->id,
            'owner_employee_id' => $employees->random()->id,
            'status' => OKRStatus::Active,
        ]);
    }
}
