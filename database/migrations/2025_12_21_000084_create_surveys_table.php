<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('created_by_employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('audience_type')->default('company'); // company, department, team, role
            $table->unsignedBigInteger('audience_id')->nullable(); // department_id, team_id, role_id
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->string('status')->default('draft'); // draft, published, closed
            $table->timestamps();
            $table->softDeletes();

            $table->index(['audience_type', 'audience_id']);
            $table->index(['starts_at', 'ends_at']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
