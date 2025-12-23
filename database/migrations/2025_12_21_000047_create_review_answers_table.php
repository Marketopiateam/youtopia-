<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('review_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('performance_reviews')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('review_questions')->cascadeOnDelete();

            $table->text('answer_text')->nullable();
            $table->decimal('rating', 3, 2)->nullable(); // For rating questions

            $table->timestamps();

            $table->index(['review_id', 'question_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('review_answers');
    }
};
