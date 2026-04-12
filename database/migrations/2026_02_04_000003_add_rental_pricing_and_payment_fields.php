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
        Schema::table('vehicles', function (Blueprint $table) {
            $table->decimal('daily_rate', 10, 2)->nullable()->after('transmission_type');
        });

        Schema::table('rental_requests', function (Blueprint $table) {
            $table->timestamp('approved_at')->nullable()->after('status');
            $table->timestamp('returned_at')->nullable()->after('approved_at');
            $table->decimal('total_cost', 10, 2)->nullable()->after('returned_at');
            $table->string('payment_status')->default('Unpaid')->after('total_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn('daily_rate');
        });

        Schema::table('rental_requests', function (Blueprint $table) {
            $table->dropColumn(['approved_at', 'returned_at', 'total_cost', 'payment_status']);
        });
    }
};
