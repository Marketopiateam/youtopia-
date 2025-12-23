<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployeeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $documentTypes = DocumentType::all();
        $users = User::all();

        if ($employees->isEmpty() || $documentTypes->isEmpty() || $users->isEmpty()) {
            $this->command->info('No employees, document types or users found, skipping employee document seeding.');
            return;
        }

        foreach ($employees as $employee) {
            EmployeeDocument::create([
                'employee_id' => $employee->id,
                'document_type_id' => $documentTypes->random()->id,
                'file_path' => 'documents/dummy.pdf',
                'uploaded_by_user_id' => $users->random()->id,
            ]);
        }
    }
}
