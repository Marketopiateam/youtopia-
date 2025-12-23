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
        DeductionType::create([
            'name' => 'Tax',
            'code' => 'TAX',
            'is_mandatory' => true,
            'is_active' => true,
        ]);

        DeductionType::create([
            'name' => 'Social Security',
            'code' => 'SS',
            'is_mandatory' => true,
            'is_active' => true,
        ]);

        DeductionType::create([
            'name' => 'Loan',
            'code' => 'LOAN',
            'is_mandatory' => false,
            'is_active' => true,
        ]);
    }
}