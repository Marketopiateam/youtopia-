<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\WorklifePost;
use Illuminate\Database\Seeder;

class WorklifePostSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::all();

        if ($employees->isEmpty()) {
            $this->command->info('No employees found, skipping WorklifePostSeeder.');
            return;
        }

        WorklifePost::factory()
            ->count(10)
            ->state(fn () => [
                'author_employee_id' => $employees->random()->id,
            ])
            ->create();
    }
}
