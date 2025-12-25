<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentTypeFactory extends Factory
{
    protected $model = DocumentType::class;

    public function definition(): array
    {
        return [
            'name' => 'Document ' . strtoupper($this->faker->unique()->bothify('DOC-#####')),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
