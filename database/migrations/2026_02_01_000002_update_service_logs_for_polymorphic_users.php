<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Update service_logs to use polymorphic relationship for users
     * This allows Admin, StaffMember, and CustomerUser to all create logs
     */
    public function up(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            // Drop existing foreign key
            try {
                $table->dropForeign(['user_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist
            }
            
            // Add user_type column for polymorphic relationship
            $table->string('user_type')->nullable()->after('user_id');
        });
        
        // Set default user_type for existing records
        DB::table('service_logs')->update(['user_type' => 'App\\Models\\User']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropColumn('user_type');
            
            // Restore foreign key
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
};
