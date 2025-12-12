<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            // Ensure role is ENUM with expected values/default.
            DB::statement("ALTER TABLE users MODIFY role ENUM('admin','staff','customer') NOT NULL DEFAULT 'customer'");

            // Add status column if missing.
            if (!Schema::hasColumn('users', 'status')) {
                DB::statement("ALTER TABLE users ADD COLUMN status ENUM('active','pending','rejected') NOT NULL DEFAULT 'active' AFTER role");
            }
        }
    }

    // Reverse the migrations.
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            // Revert status column if it exists.
            if (Schema::hasColumn('users', 'status')) {
                DB::statement("ALTER TABLE users DROP COLUMN status");
            }

            // Revert role to a simple string if needed.
            DB::statement("ALTER TABLE users MODIFY role VARCHAR(191) NOT NULL DEFAULT 'customer'");
        }
    }
};

