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
            $table->string('vehicle_name')->nullable()->after('customer_id');
            $table->string('fuel_type')->nullable()->after('vehicle_type');
            $table->string('transmission_type')->nullable()->after('fuel_type');
            $table->string('image_path')->nullable()->after('transmission_type');
            $table->boolean('is_listed_for_rent')->default(false)->after('image_path');
            $table->foreignId('rented_by_user_id')->nullable()->constrained('users')->nullOnDelete()->after('is_listed_for_rent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            try { $table->dropForeign(['rented_by_user_id']); } catch (\Exception $e) {}
            $table->dropColumn([
                'vehicle_name',
                'fuel_type',
                'transmission_type',
                'image_path',
                'is_listed_for_rent',
                'rented_by_user_id',
            ]);
        });
    }
};
