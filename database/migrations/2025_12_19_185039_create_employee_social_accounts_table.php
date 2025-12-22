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
        Schema::create('employee_social_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();

            $table->string('platform'); // facebook/linkedin/gmail/instagram/desktop/other
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('url')->nullable();

            $table->string('password_hint')->nullable();
            $table->text('notes')->nullable();

            $table->string('status')->default('active');
            $table->timestamps();

            $table->index(['employee_id', 'platform']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_social_accounts');
    }
};
