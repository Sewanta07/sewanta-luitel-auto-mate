<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Clean up owner_id values that don't exist in customers table
        DB::table('rental_requests')
            ->whereNotIn('owner_id', function ($query) {
                $query->select('id')->from('customers');
            })
            ->update(['owner_id' => null]);

        Schema::table('rental_requests', function (Blueprint $table) {
            // Drop existing foreign keys (users table)
            $table->dropForeign(['renter_id']);
            $table->dropForeign(['owner_id']);

            // Make owner_id nullable
            $table->unsignedBigInteger('owner_id')->nullable()->change();
        });

        Schema::table('rental_requests', function (Blueprint $table) {
            // Re-create foreign keys to customers table
            $table->foreign('renter_id')->references('id')->on('customers')->cascadeOnDelete();
            $table->foreign('owner_id')->references('id')->on('customers')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->dropForeign(['renter_id']);
            $table->dropForeign(['owner_id']);
        });

        Schema::table('rental_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable(false)->change();
            $table->foreign('renter_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }
};
