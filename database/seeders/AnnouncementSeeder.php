<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) {
            $this->call(UserSeeder::class);
        }
        if (Department::count() === 0) {
            $this->call(DepartmentSeeder::class);
        }

        Announcement::factory()->count(20)->make()->each(function (Announcement $announcement) {
            $announcement->created_by_user_id = User::inRandomOrder()->value('id');

            if ($announcement->target_scope?->value === 'department') {
                $announcement->target_scope_id = Department::inRandomOrder()->value('id');
            }

            $announcement->save();
        });

        $this->command->info('Announcements seeded.');
    }
}
