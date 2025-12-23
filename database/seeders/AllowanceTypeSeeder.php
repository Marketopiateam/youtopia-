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
        AllowanceType::create([
            'name' => 'Housing Allowance',
            'code' => 'HA',
            'is_taxable' => true,
            'is_active' => true,
        ]);

        AllowanceType::create([
            'name' => 'Transportation Allowance',
            'code' => 'TA',
            'is_taxable' => true,
            'is_active' => true,
        ]);

        AllowanceType::create([
            'name' => 'Meal Allowance',
            'code' => 'MA',
            'is_taxable' => false,
            'is_active' => true,
        ]);
    }
}