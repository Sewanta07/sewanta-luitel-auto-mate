<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                // Change role to string with default
                $table->string('role')->default('customer')->change();

                // Add status column if missing
                if (!Schema::hasColumn('users', 'status')) {
                    $table->string('status')->default('active');
                }
            });
        }
    }

    // Reverse the migrations.
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'status')) {
                    $table->dropColumn('status');
                }
                // Optionally revert role to previous type if needed
                $table->string('role')->default('customer')->change();
            });
        }
    }
};

