<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('service_bookings', 'service_cost')) {
                $table->decimal('service_cost', 12, 2)->nullable()->after('estimated_cost');
            }

            if (!Schema::hasColumn('service_bookings', 'spare_parts_cost')) {
                $table->decimal('spare_parts_cost', 12, 2)->default(0)->after('service_cost');
            }

            if (!Schema::hasColumn('service_bookings', 'total_amount')) {
                $table->decimal('total_amount', 12, 2)->nullable()->after('spare_parts_cost');
            }

            if (!Schema::hasColumn('service_bookings', 'payment_status')) {
                $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending')->after('total_amount');
            }
        });
    }

    public function down(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $drop = [];

            if (Schema::hasColumn('service_bookings', 'service_cost')) {
                $drop[] = 'service_cost';
            }

            if (Schema::hasColumn('service_bookings', 'spare_parts_cost')) {
                $drop[] = 'spare_parts_cost';
            }

            if (Schema::hasColumn('service_bookings', 'total_amount')) {
                $drop[] = 'total_amount';
            }

            if (Schema::hasColumn('service_bookings', 'payment_status')) {
                $drop[] = 'payment_status';
            }

            if (!empty($drop)) {
                $table->dropColumn($drop);
            }
        });
    }
};
