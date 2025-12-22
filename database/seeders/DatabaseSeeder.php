<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            DepartmentSeeder::class,
            DocumentTypeSeeder::class,
            EmployeeSeeder::class,
            UserSeeder::class,
            TicketTypeSeeder::class,
            TicketSeeder::class,

        ]);
    }
}
