<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('rental_id')->constrained('rentals')->cascadeOnDelete();
            $table->decimal('commission', 12, 2);
            $table->decimal('owner_amount', 12, 2);
            $table->enum('payout_status', ['pending', 'paid'])->default('pending');
            $table->timestamp('paid_out_at')->nullable();
            $table->timestamps();

            $table->unique('rental_id');
            $table->index(['owner_id', 'payout_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('earnings');
    }
};
