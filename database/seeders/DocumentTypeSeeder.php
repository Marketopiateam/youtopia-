<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'CV', 'is_active' => true],
            ['name' => 'National ID', 'is_active' => true],
            ['name' => 'Contract', 'is_active' => true],
            ['name' => 'Certificate', 'is_active' => true],
        ];

        foreach ($types as $type) {
            DocumentType::updateOrCreate(
                ['name' => $type['name']],
                ['is_active' => $type['is_active']]
            );
        }
    }
}
