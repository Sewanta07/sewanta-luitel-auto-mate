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
        Schema::create('withdrawal_request_earnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('withdrawal_request_id');
            $table->unsignedBigInteger('earning_id');
            $table->timestamps();

            $table->foreign('withdrawal_request_id', 'wr_earnings_wr_id_fk')->references('id')->on('withdrawal_requests')->onDelete('cascade');
            $table->foreign('earning_id', 'wr_earnings_earning_id_fk')->references('id')->on('earnings')->onDelete('cascade');
            
            $table->unique(['withdrawal_request_id', 'earning_id'], 'wr_earnings_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawal_request_earnings');
    }
};
