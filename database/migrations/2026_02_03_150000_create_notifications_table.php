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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('type'); // 'service_update', 'payment', 'rental_update', 'general'
            $table->string('title');
            $table->text('message');
            $table->string('icon_type')->default('info'); // 'info', 'success', 'warning', 'error'
            $table->unsignedBigInteger('related_id')->nullable(); // ID of related booking/rental/etc
            $table->string('related_type')->nullable(); // Type of related model
            $table->string('action_url')->nullable();
            $table->string('action_text')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->index(['customer_id', 'is_read', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
