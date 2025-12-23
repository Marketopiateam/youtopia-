<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worklife_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_employee_id')->constrained('employees')->restrictOnDelete();
            $table->string('source_type')->nullable(); // Polymorphic
            $table->unsignedBigInteger('source_id')->nullable();
            $table->string('post_type')->default('general'); // WorklifePostType enum
            $table->text('content');
            $table->string('audience_type')->default('company'); // AudienceType enum
            $table->unsignedBigInteger('audience_id')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['source_type', 'source_id']);
            $table->index(['audience_type', 'audience_id']);
            $table->index(['author_employee_id', 'published_at']);
            $table->index('is_pinned');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worklife_posts');
    }
};
