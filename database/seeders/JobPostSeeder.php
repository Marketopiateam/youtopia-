<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\JobPost;
use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }
        if (Department::count() === 0) {
            $this->call(DepartmentSeeder::class);
        }

        $employees = Employee::all();
        $departments = Department::all();

        JobPost::factory()->count(20)->make()->each(function ($jobPost) use ($employees, $departments) {
            $jobPost->created_by_employee_id = $employees->random()->id;
            $jobPost->department_id = $departments->random()->id;
            $jobPost->save();
        });

        $this->command->info('Job Posts seeded.');
    }
}
