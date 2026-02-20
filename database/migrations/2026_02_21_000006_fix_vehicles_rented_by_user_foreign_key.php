<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->dropForeignKeyIfExists('vehicles', 'rented_by_user_id');

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
        $this->dropForeignKeyIfExists('vehicles', 'rented_by_user_id');

        if (Schema::hasTable('users')) {
            Schema::table('vehicles', function (Blueprint $table) {
                $table->foreign('rented_by_user_id')
                    ->references('id')
                    ->on('users')
                    ->nullOnDelete();
            });
        }
    }

    private function dropForeignKeyIfExists(string $table, string $column): void
    {
        $database = DB::getDatabaseName();

        $foreignKeys = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->select('CONSTRAINT_NAME')
            ->where('TABLE_SCHEMA', $database)
            ->where('TABLE_NAME', $table)
            ->where('COLUMN_NAME', $column)
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->pluck('CONSTRAINT_NAME');

        foreach ($foreignKeys as $constraintName) {
            DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$constraintName}`");
        }
    }
};
