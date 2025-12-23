<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('performance_review_templates')->cascadeOnDelete();

            $table->text('question_text');
            $table->string('question_type'); // text, rating, multiple_choice
            $table->integer('weight')->default(1); // For weighted scoring
            $table->integer('order')->default(0);

            $table->timestamps();

            $table->index(['template_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_questions');
    }
};
