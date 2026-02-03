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
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->string('renter_contact')->nullable()->after('notes');
            $table->string('pickup_location')->nullable()->after('renter_contact');
            $table->text('service_link')->nullable()->after('pickup_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->dropColumn(['renter_contact', 'pickup_location', 'service_link']);
        });
    }
};
