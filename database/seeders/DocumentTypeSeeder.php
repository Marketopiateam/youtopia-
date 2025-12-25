<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::firstOrCreate(['name' => 'National ID Card'], ['is_active' => true]);
        DocumentType::firstOrCreate(['name' => 'Passport'], ['is_active' => true]);
        DocumentType::firstOrCreate(['name' => 'Employment Contract'], ['is_active' => true]);
        DocumentType::firstOrCreate(['name' => 'Resume'], ['is_active' => true]);
        DocumentType::firstOrCreate(['name' => 'Offer Letter'], ['is_active' => true]);
        DocumentType::firstOrCreate(['name' => 'Bank Account Details'], ['is_active' => true]);

        for ($i = 1; $i <= 5; $i++) {
            DocumentType::firstOrCreate(
                ['name' => "Custom Document {$i}"],
                ['is_active' => true]
            );
        }

        $this->command->info('Document Types seeded.');
    }
}
