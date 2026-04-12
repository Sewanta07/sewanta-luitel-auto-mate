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
            // Drop the existing foreign key constraint
            $table->dropForeign(['customer_id']);
            
            // Modify the column to be nullable
            $table->foreignId('customer_id')->nullable()->change()->constrained('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Drop the foreign key
            $table->dropForeign(['customer_id']);
            
            // Make customer_id NOT nullable again
            $table->foreignId('customer_id')->change()->constrained('customers')->onDelete('cascade');
        });
    }
};
