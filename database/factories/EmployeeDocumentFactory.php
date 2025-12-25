<?php

namespace Database\Factories;

use App\Models\EmployeeDocument;
use App\Models\Employee;
use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeDocumentFactory extends Factory
{
    protected $model = EmployeeDocument::class;

    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'document_type_id' => DocumentType::inRandomOrder()->value('id') ?? DocumentType::factory(),
            'file_path' => 'documents/' . $this->faker->uuid . '.pdf',
            'issued_at' => $this->faker->boolean(70) ? $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d') : null,
            'expires_at' => $this->faker->boolean(50) ? $this->faker->dateTimeBetween('now', '+5 years')->format('Y-m-d') : null,
            'notes' => $this->faker->boolean(40) ? $this->faker->sentence : null,
            'uploaded_by_user_id' => \App\Models\User::factory(),
        ];
    }
}
