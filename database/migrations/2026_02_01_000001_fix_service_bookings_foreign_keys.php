<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration fixes the foreign key constraints to use the correct tables:
     * - customer_id should reference 'customers' table (not 'users')
     * - staff_id should reference 'staff_members' table (not 'users')
     */
    public function up(): void
    {
        // Drop existing foreign keys if they exist
        Schema::table('service_bookings', function (Blueprint $table) {
            try { $table->dropForeign(['customer_id']); } catch (\Exception $e) {}
            try { $table->dropForeign(['staff_id']); } catch (\Exception $e) {}
        });

        // Clean up invalid references before adding new foreign keys
        DB::table('service_bookings')
            ->whereNotIn('customer_id', function ($query) {
                $query->select('id')->from('customers');
            })
            ->delete();

        DB::table('service_bookings')
            ->whereNotNull('staff_id')
            ->whereNotIn('staff_id', function ($query) {
                $query->select('id')->from('staff_members');
            })
            ->update(['staff_id' => null]);

        // Add correct foreign keys
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            $table->foreign('staff_id')
                ->references('id')
                ->on('staff_members')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_bookings', function (Blueprint $table) {
            try { $table->dropForeign(['customer_id']); } catch (\Exception $e) {}
            try { $table->dropForeign(['staff_id']); } catch (\Exception $e) {}
        });

        // Restore old foreign keys (to users table)
        Schema::table('service_bookings', function (Blueprint $table) {
            $table->foreign('customer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('staff_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }
};
