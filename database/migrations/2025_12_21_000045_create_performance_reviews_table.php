<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('performance_review_templates')->restrictOnDelete();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('reviewer_employee_id')->constrained('employees')->restrictOnDelete();

            $table->date('review_period_start');
            $table->date('review_period_end');

            $table->decimal('overall_rating', 3, 2)->nullable(); // e.g., 4.50 out of 5
            $table->text('summary')->nullable();

            $table->string('status')->default('draft'); // ReviewStatus enum
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

            $table->index(['employee_id', 'status']);
            $table->index(['reviewer_employee_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_reviews');
    }
};
