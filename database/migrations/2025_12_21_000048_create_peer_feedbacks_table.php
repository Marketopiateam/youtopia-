<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peer_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('reviewer_employee_id')->constrained('employees')->cascadeOnDelete();

            $table->text('feedback_text');
            $table->decimal('rating', 3, 2)->nullable(); // Optional rating
            $table->boolean('is_anonymous')->default(false);

            $table->timestamp('submitted_at');
            $table->timestamps();

            $table->index(['employee_id', 'submitted_at']);
            $table->index('reviewer_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peer_feedbacks');
    }
};
