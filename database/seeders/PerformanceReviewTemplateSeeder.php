<?php

namespace Database\Seeders;

use App\Models\PerformanceReviewTemplate;
use Illuminate\Database\Seeder;

class PerformanceReviewTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PerformanceReviewTemplate::create([
            'name' => 'Annual Performance Review',
            'description' => 'Comprehensive annual review for all employees.',
            'is_active' => true,
        ]);

        PerformanceReviewTemplate::create([
            'name' => 'Mid-Year Performance Check-in',
            'description' => 'A lighter review to assess progress midway through the year.',
            'is_active' => true,
        ]);
    }
}
