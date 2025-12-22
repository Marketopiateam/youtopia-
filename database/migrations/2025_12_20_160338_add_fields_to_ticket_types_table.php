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
        Schema::table('ticket_types', function (Blueprint $table) {
            $table->string('code')
                ->nullable()
                ->after('id')
                ->comment('Optional short code');

            $table->boolean('needs_dates')
                ->default(false)
                ->after('is_active')
                ->comment('Requires expected_from / expected_to');

            $table->boolean('needs_amount')
                ->default(false)
                ->after('needs_dates')
                ->comment('Requires amount');

            $table->boolean('allow_attachments')
                ->default(false)
                ->after('needs_amount')
                ->comment('Allow file uploads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ticket_types', function (Blueprint $table) {
            //
        });
    }
};
