<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            if (! Schema::hasColumn('leave_requests', 'days_count')) {
                $table->decimal('days_count', 5, 2)->nullable()->after('end_date');
            }
            if (! Schema::hasColumn('leave_requests', 'submitted_at')) {
                $table->timestamp('submitted_at')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            if (Schema::hasColumn('leave_requests', 'days_count')) {
                $table->dropColumn('days_count');
            }
            if (Schema::hasColumn('leave_requests', 'submitted_at')) {
                $table->dropColumn('submitted_at');
            }
        });
    }
};
