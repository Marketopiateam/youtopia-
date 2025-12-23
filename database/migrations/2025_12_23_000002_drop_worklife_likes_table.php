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
        Schema::dropIfExists('worklife_likes');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If you ever need to roll back, you might want to re-create the table
        // However, since we're replacing it with a more generic reactions table,
        // re-creating it might not be the desired behavior.
        // For a production system, carefully consider rollback strategies.
        Schema::create('worklife_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('post_id')->nullable()->constrained('worklife_posts')->cascadeOnDelete();
            $table->foreignId('comment_id')->nullable()->constrained('worklife_comments')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['employee_id', 'post_id']);
            $table->unique(['employee_id', 'comment_id']);
        });
    }
};
