<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Remove foreign key constraints pointing to users table,
     * then drop the legacy users table.
     */
    public function up(): void
    {
        // Disable foreign key checks to drop the table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        Schema::dropIfExists('users');
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'staff', 'customer'])->default('customer');
            $table->enum('status', ['active', 'pending', 'rejected'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }
};
