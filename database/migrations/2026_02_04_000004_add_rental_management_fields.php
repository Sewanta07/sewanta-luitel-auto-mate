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
        // Add admin/staff management fields to rental_requests
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('assigned_staff_id')->nullable()->after('owner_id');
            $table->timestamp('ready_for_pickup_at')->nullable()->after('approved_at');
            $table->timestamp('picked_up_at')->nullable()->after('ready_for_pickup_at');
            $table->text('pre_inspection_notes')->nullable();
            $table->text('post_inspection_notes')->nullable();
            $table->json('pre_inspection_images')->nullable();
            $table->json('post_inspection_images')->nullable();
            $table->boolean('has_damage')->default(false);
            $table->text('damage_description')->nullable();
            $table->decimal('damage_charge', 10, 2)->nullable();
            $table->string('rejection_reason')->nullable();
            
            $table->foreign('assigned_staff_id')->references('id')->on('staff_members')->onDelete('set null');
        });
        
        // Add fields to vehicles for service center rental management
        Schema::table('vehicles', function (Blueprint $table) {
            $table->boolean('is_service_center_vehicle')->default(false)->after('customer_id');
            $table->decimal('security_deposit', 10, 2)->nullable()->after('daily_rate');
            $table->text('rental_rules')->nullable();
            $table->enum('listing_status', ['pending', 'approved', 'rejected', 'suspended'])->default('approved')->after('is_listed_for_rent');
            $table->text('listing_rejection_reason')->nullable();
            $table->timestamp('listing_approved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->dropForeign(['assigned_staff_id']);
            $table->dropColumn([
                'assigned_staff_id',
                'ready_for_pickup_at',
                'picked_up_at',
                'pre_inspection_notes',
                'post_inspection_notes',
                'pre_inspection_images',
                'post_inspection_images',
                'has_damage',
                'damage_description',
                'damage_charge',
                'rejection_reason',
            ]);
        });
        
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn([
                'is_service_center_vehicle',
                'security_deposit',
                'rental_rules',
                'listing_status',
                'listing_rejection_reason',
                'listing_approved_at',
            ]);
        });
    }
};
