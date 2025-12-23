<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goal_links', function (Blueprint $table) {
            $table->id();
            $table->string('goal_type'); // 'company' or 'department'
            $table->unsignedBigInteger('goal_id'); // company_goal_id or department_goal_id
            $table->foreignId('objective_id')->constrained('okr_objectives')->cascadeOnDelete();
            $table->timestamps();

            $table->index(['goal_type', 'goal_id']);
            $table->index('objective_id');
            $table->unique(['goal_type', 'goal_id', 'objective_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goal_links');
    }
};
