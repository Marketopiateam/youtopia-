<?php

namespace Database\Seeders;

use App\Models\EmployeeDocument;
use App\Models\Employee;
use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class EmployeeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure employees and document types exist
        if (Employee::count() === 0) {
            $this->call(EmployeeSeeder::class);
        }
        if (DocumentType::count() === 0) {
            $this->call(DocumentTypeSeeder::class);
        }

        $employees = Employee::all();
        $documentTypes = DocumentType::all();

        foreach ($employees as $employee) {
            // Give each employee 2-5 documents
            for ($i = 0; $i < rand(2, 5); $i++) {
                EmployeeDocument::factory()->make()->each(function ($doc) use ($employee, $documentTypes) {
                    $doc->employee_id = $employee->id;
                    $doc->document_type_id = $documentTypes->random()->id;
                    $doc->save();
                });
            }
        }

        $this->command->info('Employee Documents seeded.');
    }
}