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
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('priority')->default('medium')->after('reason');

            $table->date('expected_from')->nullable()->after('priority');
            $table->date('expected_to')->nullable()->after('expected_from');

            $table->decimal('amount', 12, 2)->nullable()->after('expected_to');

            $table->json('attachments')->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
};
