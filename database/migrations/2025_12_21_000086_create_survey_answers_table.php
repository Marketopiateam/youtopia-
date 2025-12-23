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
        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_response_id')->constrained('survey_responses')->cascadeOnDelete();
            $table->foreignId('survey_question_id')->constrained('survey_questions')->cascadeOnDelete();
            $table->text('answer_text')->nullable(); // For text, rating answers
            $table->foreignId('survey_question_option_id')->nullable()->constrained('survey_question_options')->cascadeOnDelete(); // For multiple choice options
            $table->timestamps();

            $table->unique(['survey_response_id', 'survey_question_id']);
            $table->index(['survey_response_id', 'survey_question_id']);
            $table->index('survey_question_option_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
    }
};
