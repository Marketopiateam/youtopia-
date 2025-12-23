<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('okr_key_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objective_id')->constrained('okr_objectives')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();

            $table->decimal('target_value', 10, 2);
            $table->decimal('current_value', 10, 2)->default(0);
            $table->string('unit')->nullable(); // e.g., '%', 'count', 'USD'

            $table->integer('weight_percentage')->default(100); // For weighted objectives
            $table->string('status')->default('not_started'); // OKRStatus enum

            $table->timestamps();

            $table->index(['objective_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('okr_key_results');
    }
};
