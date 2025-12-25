<?php

namespace Database\Seeders;

use App\Models\AllowanceType;
use Illuminate\Database\Seeder;

class AllowanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AllowanceType::firstOrCreate(
            ['name' => 'Housing Allowance'],
            ['code' => 'ALW-HOUSING', 'is_taxable' => true, 'is_active' => true]
        );
        AllowanceType::firstOrCreate(
            ['name' => 'Transportation Allowance'],
            ['code' => 'ALW-TRANSPORT', 'is_taxable' => true, 'is_active' => true]
        );
        AllowanceType::firstOrCreate(
            ['name' => 'Meal Allowance'],
            ['code' => 'ALW-MEAL', 'is_taxable' => false, 'is_active' => true]
        );
        AllowanceType::firstOrCreate(
            ['name' => 'Medical Allowance'],
            ['code' => 'ALW-MED', 'is_taxable' => false, 'is_active' => true]
        );

        for ($i = 1; $i <= 5; $i++) {
            AllowanceType::firstOrCreate(
                ['name' => "Custom Allowance {$i}"],
                ['code' => "ALW-CUSTOM-{$i}", 'is_taxable' => true, 'is_active' => true]
            );
        }

        $this->command->info('Allowance Types seeded.');
    }
}
