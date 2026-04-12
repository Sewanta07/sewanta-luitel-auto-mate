<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the foreign key using Laravel's schema builder
        Schema::table('vehicles', function (Blueprint $table) {
            try { $table->dropForeign(['rented_by_user_id']); } catch (\Exception $e) {}
        });

        DB::table('vehicles')
            ->whereNotNull('rented_by_user_id')
            ->whereNotIn('rented_by_user_id', function ($query) {
                $query->select('id')->from('customers');
            })
            ->update(['rented_by_user_id' => null]);

        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('rented_by_user_id')
                ->references('id')
                ->on('customers')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            try { $table->dropForeign(['rented_by_user_id']); } catch (\Exception $e) {}
        });

        if (Schema::hasTable('users')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->foreign('rented_by_user_id')
                    ->references('id')
                    ->on('users')
                    ->nullOnDelete();
            });
        }
    }
};
