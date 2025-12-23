<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('department_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('quarter'); // 1, 2, 3, 4
            $table->integer('year');
            $table->string('status')->default('draft'); // GoalType enum
            $table->foreignId('owner_employee_id')->constrained('employees')->restrictOnDelete();
            $table->timestamps();

            $table->index(['department_id', 'quarter', 'year']);
            $table->index(['status', 'quarter', 'year']);
            $table->index('owner_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('department_goals');
    }
};
