<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $table->string('order_id')->index();
            $table->string('transaction_id')->nullable()->index();
            $table->string('status')->index();
            $table->json('payload')->nullable();
            $table->timestamps();

            $table->index(['transaction_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
