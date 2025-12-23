<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('created_by_employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('url')->nullable(); // External job posting URL
            $table->string('status')->default('draft'); // Enum: draft, published, closed, cancelled
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at']);
            $table->index('department_id');
            $table->index('created_by_employee_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
