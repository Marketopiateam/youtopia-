<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing users to ensure idempotency
        // User::query()->delete(); // Consider if you want to delete all users or just update.
                                 // For initial seeding, deleting might be acceptable.
                                 // For re-runability in production, firstOrCreate is better.

        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'default_panel' => 'admin',
            ]
        );
        $superAdmin->assignRole('super_admin');
        $this->command->info('Super Admin created: superadmin@example.com / password');

        // Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'default_panel' => 'admin',
            ]
        );
        $admin->assignRole('admin');
        $this->command->info('Admin User created: admin@example.com / password');

        // HR Manager
        $hrManager = User::firstOrCreate(
            ['email' => 'hr@example.com'],
            [
                'name' => 'HR Manager',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'default_panel' => 'hr',
            ]
        );
        $hrManager->assignRole('hr');
        $this->command->info('HR Manager created: hr@example.com / password');

        // Department Manager
        $deptManager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Department Manager',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'default_panel' => 'manager',
            ]
        );
        $deptManager->assignRole('manager');
        $this->command->info('Department Manager created: manager@example.com / password');

        // Employee
        $employee = User::firstOrCreate(
            ['email' => 'employee@example.com'],
            [
                'name' => 'Regular Employee',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'default_panel' => 'employee',
            ]
        );
        $employee->assignRole('employee');
        $this->command->info('Regular Employee created: employee@example.com / password');

        // Create additional employee accounts deterministically to avoid email collisions
        for ($i = 1; $i <= 10; $i++) {
            $email = "employee{$i}@example.com";
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => "Employee {$i}",
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'default_panel' => 'employee',
                ]
            );
            $user->assignRole('employee');
        }

        $this->command->info('Additional 10 deterministic employees created.');

        $this->command->info('Default login credentials:');
        $this->command->info('Super Admin: superadmin@example.com / password');
        $this->command->info('Admin User: admin@example.com / password');
        $this->command->info('HR Manager: hr@example.com / password');
        $this->command->info('Department Manager: manager@example.com / password');
        $this->command->info('Regular Employee: employee@example.com / password');
    }
}
