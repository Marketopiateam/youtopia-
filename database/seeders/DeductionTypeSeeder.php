<?php

namespace Database\Seeders;

use App\Models\DeductionType;
use Illuminate\Database\Seeder;

class DeductionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeductionType::firstOrCreate(
            ['name' => 'Income Tax'],
            ['code' => 'DED-TAX', 'is_mandatory' => true, 'is_active' => true]
        );
        DeductionType::firstOrCreate(
            ['name' => 'Social Security'],
            ['code' => 'DED-SS', 'is_mandatory' => true, 'is_active' => true]
        );
        DeductionType::firstOrCreate(
            ['name' => 'Health Insurance'],
            ['code' => 'DED-HEALTH', 'is_mandatory' => false, 'is_active' => true]
        );
        DeductionType::firstOrCreate(
            ['name' => 'Retirement Plan'],
            ['code' => 'DED-RET', 'is_mandatory' => false, 'is_active' => true]
        );

        for ($i = 1; $i <= 5; $i++) {
            DeductionType::firstOrCreate(
                ['name' => "Custom Deduction {$i}"],
                ['code' => "DED-CUSTOM-{$i}", 'is_mandatory' => false, 'is_active' => true]
            );
        }

        $this->command->info('Deduction Types seeded.');
    }
}
