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
        $this->dropForeignKeyIfExists('service_bookings', 'customer_id');
        $this->dropForeignKeyIfExists('service_bookings', 'staff_id');

        // Clean up invalid references before adding new foreign keys
        // Remove bookings with missing customers (cannot be null)
        DB::table('service_bookings')
            ->whereNotIn('customer_id', function ($query) {
                $query->select('id')->from('customers');
            })
            ->delete();

        // Null out invalid staff assignments (staff_id is nullable)
        DB::table('service_bookings')
            ->whereNotNull('staff_id')
            ->whereNotIn('staff_id', function ($query) {
                $query->select('id')->from('staff_members');
            })
            ->update(['staff_id' => null]);

        // Add correct foreign keys
        Schema::table('service_bookings', function (Blueprint $table) {
            // Customer ID references customers table
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade');
            
            // Staff ID references staff_members table
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
        $this->dropForeignKeyIfExists('service_bookings', 'customer_id');
        $this->dropForeignKeyIfExists('service_bookings', 'staff_id');

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

    private function dropForeignKeyIfExists(string $table, string $column): void
    {
        $database = DB::getDatabaseName();

        $foreignKey = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->select('CONSTRAINT_NAME')
            ->where('TABLE_SCHEMA', $database)
            ->where('TABLE_NAME', $table)
            ->where('COLUMN_NAME', $column)
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->first();

        if ($foreignKey && $foreignKey->CONSTRAINT_NAME) {
            DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$foreignKey->CONSTRAINT_NAME}`");
        }
    }
};
