<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_cycle_id')->constrained('payroll_cycles')->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->decimal('basic_salary', 15, 2);
            $table->decimal('total_earnings', 15, 2)->default(0);
            $table->decimal('total_deductions', 15, 2)->default(0);
            $table->decimal('net_salary', 15, 2);
            $table->string('currency_code', 3)->default('USD');
            $table->timestamp('generated_at');
            $table->timestamps();

            $table->unique(['payroll_cycle_id', 'employee_id']);
            $table->index(['employee_id', 'generated_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
