<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // مهم: reset cache
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            'admin' => [
                'ViewAny:Ticket', 'View:Ticket', 'Create:Ticket', 'Update:Ticket', 'Delete:Ticket',
                'ViewAny:Employee', 'View:Employee', 'Create:Employee', 'Update:Employee', 'Delete:Employee',
                'ViewAny:Department', 'View:Department', 'Create:Department', 'Update:Department', 'Delete:Department',
                'ViewAny:User', 'View:User', 'Create:User', 'Update:User', 'Delete:User',
            ],
            'hr' => [
                'ViewAny:Ticket', 'View:Ticket', 'Update:Ticket',
                'ViewAny:Employee', 'View:Employee', 'Create:Employee', 'Update:Employee',
                'ViewAny:Department', 'View:Department',
                'ViewAny:User', 'View:User',
            ],
            'manager' => [
                'ViewAny:Ticket', 'View:Ticket', 'Update:Ticket',
                'ViewAny:Employee', 'View:Employee',
                'ViewAny:Department', 'View:Department',
            ],
            'employee' => [
                'ViewAny:Ticket', 'View:Ticket', 'Create:Ticket', 'Update:Ticket',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            foreach ($permissions as $permission) {
                $perm = Permission::firstOrCreate([
                    'name' => $permission,
                    'guard_name' => 'web',
                ]);
                $role->givePermissionTo($perm);
            }
        }
    }
}
