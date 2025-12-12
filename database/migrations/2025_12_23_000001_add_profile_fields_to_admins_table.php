<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('admins')) {
            Schema::table('admins', function (Blueprint $table) {
                if (!Schema::hasColumn('admins', 'phone')) {
                    $table->string('phone')->nullable()->after('email');
                }
                if (!Schema::hasColumn('admins', 'current_address')) {
                    $table->text('current_address')->nullable()->after('phone');
                }
                if (!Schema::hasColumn('admins', 'profile_image')) {
                    $table->string('profile_image')->nullable()->after('current_address');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('admins')) {
            Schema::table('admins', function (Blueprint $table) {
                if (Schema::hasColumn('admins', 'phone')) {
                    $table->dropColumn('phone');
                }
                if (Schema::hasColumn('admins', 'current_address')) {
                    $table->dropColumn('current_address');
                }
                if (Schema::hasColumn('admins', 'profile_image')) {
                    $table->dropColumn('profile_image');
                }
            });
        }
    }
};

