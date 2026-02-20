<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('owner_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
            $table->decimal('daily_rate', 12, 2);
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->boolean('is_available')->default(true);
            $table->text('approval_note')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->unique('vehicle_id');
            $table->index(['owner_id', 'approval_status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('owner_vehicles');
    }
};
