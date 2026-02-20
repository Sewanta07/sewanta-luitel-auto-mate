<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles')->cascadeOnDelete();
            $table->foreignId('owner_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('renter_id')->constrained('customers')->cascadeOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('number_of_days');
            $table->decimal('total_amount', 12, 2);
            $table->decimal('commission_amount', 12, 2)->default(0);
            $table->decimal('owner_earning', 12, 2)->default(0);
            $table->decimal('damage_charge', 12, 2)->nullable();
            $table->text('damage_notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed'])->default('pending');
            $table->timestamp('damage_invoice_generated_at')->nullable();
            $table->timestamps();

            $table->index(['owner_id', 'status']);
            $table->index(['renter_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
