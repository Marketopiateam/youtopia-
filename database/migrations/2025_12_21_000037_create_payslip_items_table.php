<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payslip_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payslip_id')->constrained('payslips')->cascadeOnDelete();
            $table->string('item_type'); // Enum cast: earning, deduction
            $table->unsignedBigInteger('type_id'); // allowance_type_id or deduction_type_id
            $table->decimal('amount', 15, 2);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->index(['payslip_id', 'item_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payslip_items');
    }
};
