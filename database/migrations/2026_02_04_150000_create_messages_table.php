<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_type'); // StaffMember, CustomerUser, Admin
            $table->unsignedBigInteger('receiver_id');
            $table->string('receiver_type'); // StaffMember, CustomerUser, Admin
            $table->unsignedBigInteger('service_booking_id')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['sender_id', 'sender_type']);
            $table->index(['receiver_id', 'receiver_type']);
            $table->index('service_booking_id');
            $table->foreign('service_booking_id')->references('id')->on('service_bookings')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
