<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles if they don't exist
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $hrRole = Role::firstOrCreate(['name' => 'hr']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);

        // Define a basic set of permissions (these would typically be more granular)
        // For a full ERP, permissions would be extensive and managed by modules.
        // We'll create some common ones for demonstration.
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'manage employees',
            'manage departments',
            'manage attendance',
            'manage payroll',
            'view own profile',
            'submit leave requests',
            'approve leave requests', // HR and Manager
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Assign all permissions to super_admin
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign specific permissions to other roles
        $adminRole->givePermissionTo([
            'view dashboard',
            'manage users',
            'manage roles',
            'manage employees',
            'manage departments',
        ]);

        $hrRole->givePermissionTo([
            'view dashboard',
            'manage employees',
            'manage departments',
            'manage attendance',
            'approve leave requests',
        ]);

        $managerRole->givePermissionTo([
            'view dashboard',
            'manage employees', // limited to their department
            'manage attendance', // limited to their department
            'approve leave requests', // limited to their department
            'view own profile',
            'submit leave requests',
        ]);

        $employeeRole->givePermissionTo([
            'view dashboard',
            'view own profile',
            'submit leave requests',
        ]);

        $this->command->info('Roles and basic permissions seeded.');
    }
}