<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->foreignId('created_by_user_id')->constrained('users')->restrictOnDelete();
            $table->string('target_scope')->default('company'); // company/department
            $table->unsignedBigInteger('target_scope_id')->nullable(); // department_id if department scope
            $table->timestamp('publish_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['target_scope', 'target_scope_id']);
            $table->index(['publish_at', 'expires_at']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
