<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approval_request_id')->constrained('approval_requests')->cascadeOnDelete();
            $table->foreignId('step_id')->constrained('approval_steps')->restrictOnDelete();
            $table->foreignId('approver_employee_id')->constrained('employees')->restrictOnDelete();
            $table->string('action'); // approved, rejected
            $table->text('notes')->nullable();
            $table->timestamp('acted_at');
            $table->timestamps();

            $table->index('approval_request_id');
            $table->index(['approver_employee_id', 'acted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_actions');
    }
};
