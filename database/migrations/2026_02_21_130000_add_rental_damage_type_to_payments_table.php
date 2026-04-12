<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Change 'type' column to string for PostgreSQL compatibility
        Schema::table('payments', function (Blueprint $table) {
            $table->string('type', 32)->default('service')->change();
        });
    }

    public function down(): void
    {
        // Optionally revert to previous state (still as string for portability)
        Schema::table('payments', function (Blueprint $table) {
            $table->string('type', 32)->default('service')->change();
        });
    }
};
