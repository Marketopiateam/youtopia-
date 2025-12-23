<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('okr_objectives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cycle_id')->constrained('okr_cycles')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();

            // Scope: company, department, or employee
            $table->string('scope'); // OKRScope enum
            $table->unsignedBigInteger('scope_id')->nullable(); // department_id or employee_id

            $table->foreignId('owner_employee_id')->constrained('employees')->restrictOnDelete();
            $table->foreignId('parent_objective_id')->nullable()->constrained('okr_objectives')->nullOnDelete();

            $table->decimal('progress_percentage', 5, 2)->default(0);
            $table->string('status')->default('draft'); // OKRStatus enum

            $table->timestamps();

            $table->index(['cycle_id', 'scope', 'scope_id']);
            $table->index(['owner_employee_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('okr_objectives');
    }
};
