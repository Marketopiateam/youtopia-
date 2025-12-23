<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Employee; // Keep for type hinting if needed elsewhere, but not for creation

class UserSeeder extends Seeder
{
    private function createUser(
        string $role,
        string $email,
        string $name,
        string $panel
    ): User {
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => 'password',
                'default_panel' => $panel,
            ]
        );
        $user->assignRole($role);
        return $user;
    }

    public function run(): void
    {
        // Admin user
        $this->createUser('admin', 'admin@admin.com', 'Admin User', 'admin');

        // 5 HR Users
        for ($i = 1; $i <= 5; $i++) {
            $this->createUser('hr', "hr{$i}@demo.com", "HR User {$i}", 'hr');
        }

        // 5 Manager Users
        for ($i = 1; $i <= 5; $i++) {
            $this->createUser('manager', "manager{$i}@demo.com", "Manager User {$i}", 'manager');
        }

        // 20 Employee Users
        for ($i = 1; $i <= 20; $i++) {
            $this->createUser('employee', "employee{$i}@demo.com", "Employee User {$i}", 'employee');
        }

        $this->command->info('Created users and assigned roles successfully');
    }
}
