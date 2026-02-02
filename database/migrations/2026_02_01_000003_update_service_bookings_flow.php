<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->string('booking_code')->nullable()->after('id');
            $table->string('vehicle_name')->nullable()->after('vehicle_model');
            $table->unsignedSmallInteger('vehicle_year')->nullable()->after('vehicle_name');
            $table->string('custom_service')->nullable()->after('service_type');
            $table->string('preferred_time_slot')->nullable()->after('preferred_date');
            $table->string('service_priority')->default('Normal')->after('preferred_time_slot');
            $table->string('service_location_type')->nullable()->after('service_priority');
            $table->text('notes')->nullable()->after('problem_description');
            $table->boolean('rental_required')->default(false)->after('notes');
            $table->boolean('pickup_drop')->default(false)->after('rental_required');
            $table->decimal('estimated_cost', 10, 2)->nullable()->after('pickup_drop');
            $table->date('expected_completion_date')->nullable()->after('estimated_cost');
            $table->text('rejection_reason')->nullable()->after('expected_completion_date');
        });

        // Backfill booking codes for existing rows
        DB::table('service_bookings')
            ->whereNull('booking_code')
            ->orderBy('id')
            ->chunkById(100, function ($rows) {
                foreach ($rows as $row) {
                    $code = null;
                    do {
                        $code = 'BK-' . Str::upper(Str::random(8));
                    } while (DB::table('service_bookings')->where('booking_code', $code)->exists());

                    DB::table('service_bookings')->where('id', $row->id)->update([
                        'booking_code' => $code,
                    ]);
                }
            });

        Schema::table('service_bookings', function (Blueprint $table) {
            $table->unique('booking_code');
        });
    }

    public function down(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->dropUnique(['booking_code']);
            $table->dropColumn([
                'booking_code',
                'vehicle_name',
                'vehicle_year',
                'custom_service',
                'preferred_time_slot',
                'service_priority',
                'service_location_type',
                'notes',
                'rental_required',
                'pickup_drop',
                'estimated_cost',
                'expected_completion_date',
                'rejection_reason',
            ]);
        });
    }
};
