<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approval_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workflow_id')->constrained('approval_workflows')->restrictOnDelete();
            $table->string('requestable_type'); // Polymorphic
            $table->unsignedBigInteger('requestable_id');
            $table->foreignId('requester_employee_id')->constrained('employees')->restrictOnDelete();
            $table->integer('current_step')->default(1);
            $table->string('status')->default('pending'); // ApprovalStatus enum
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['requestable_type', 'requestable_id']);
            $table->index(['status', 'current_step']);
            $table->index('requester_employee_id');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('approval_requests');
    }
};
