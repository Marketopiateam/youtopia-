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
        Schema::create('worklife_reactions', function (Blueprint $table) {
            $table->id();
            $table->string('reactable_type');
            $table->unsignedBigInteger('reactable_id');
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('reaction_type'); // e.g., 'like', 'heart', 'laugh', 'sad', 'angry'
            $table->timestamps();

            $table->unique(['reactable_type', 'reactable_id', 'employee_id', 'reaction_type'], 'worklife_reactions_unique_reaction');
            $table->index(['reactable_type', 'reactable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worklife_reactions');
    }
};
