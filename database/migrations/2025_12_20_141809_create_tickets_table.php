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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('ticket_type_id')->constrained('ticket_types')->restrictOnDelete();

            $table->text('reason')->nullable();

            // enum cast
            $table->string('status')->default('pending_manager');

            // submit info
            $table->timestamp('submitted_at')->nullable();

            // Manager decision
            $table->boolean('manager_approved')->nullable();
            $table->text('manager_reason')->nullable();
            $table->timestamp('manager_action_at')->nullable();
            $table->string('manager_actor_email')->nullable(); // بدل user_id مؤقتًا

            // HR decision
            $table->boolean('hr_approved')->nullable();
            $table->text('hr_reason')->nullable();
            $table->timestamp('hr_action_at')->nullable();
            $table->string('hr_actor_email')->nullable(); // بدل user_id مؤقتًا

            $table->timestamps();

            $table->index(['status', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
