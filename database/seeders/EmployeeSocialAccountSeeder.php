<?php

namespace Database\Seeders;

use App\Models\EmployeeSocialAccount;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSocialAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure employees exist
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }

        $employees = Employee::all();
        $faker = \Faker\Factory::create();

        // Create social accounts for about half of the employees
        foreach ($employees->random(ceil($employees->count() / 2)) as $employee) {
            // Give each selected employee 1-3 social accounts
            for ($i = 0; $i < rand(1, 3); $i++) {
                EmployeeSocialAccount::factory()->make()->each(function ($socialAccount) use ($employee) {
                    $socialAccount->employee_id = $employee->id;
                    $existingPlatforms = $employee->socialAccounts->pluck('platform')->toArray();
                    $availablePlatforms = array_diff(
                        ['linkedin', 'github', 'twitter', 'gmail', 'instagram', 'other'],
                        $existingPlatforms
                    );

                    if (empty($availablePlatforms)) {
                        return; // No more unique platforms to add for this employee
                    }

                    $socialAccount->platform = $faker->randomElement($availablePlatforms);

                    $socialAccount->save();
                });
            }
        }

        $this->command->info('Employee Social Accounts seeded.');
    }
}
