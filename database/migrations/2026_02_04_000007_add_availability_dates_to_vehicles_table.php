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
            $table->date('availability_start')->nullable()->after('listing_status');
            $table->date('availability_end')->nullable()->after('availability_start');
            $table->string('pickup_location')->nullable()->after('availability_end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['availability_start', 'availability_end', 'pickup_location']);
        });
    }
};
