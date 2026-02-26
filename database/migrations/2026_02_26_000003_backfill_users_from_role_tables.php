<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        $this->copyRoleTable('admins', 'admin');
        $this->copyRoleTable('staff_members', 'staff');
        $this->copyRoleTable('customers', 'customer');
    }

    public function down(): void
    {
        // Intentionally left empty to avoid deleting legitimate users records.
    }

    private function copyRoleTable(string $table, string $role): void
    {
        if (!Schema::hasTable($table)) {
            return;
        }

        DB::table($table)
            ->select('name', 'email', 'password', 'status', 'created_at', 'updated_at')
            ->orderBy('id')
            ->chunk(200, function ($rows) use ($role) {
                $payload = [];

                foreach ($rows as $row) {
                    if (empty($row->email)) {
                        continue;
                    }

                    $payload[] = [
                        'name' => $row->name ?? 'User',
                        'email' => $row->email,
                        'password' => $row->password,
                        'role' => $role,
                        'status' => $row->status ?? 'active',
                        'created_at' => $row->created_at ?? now(),
                        'updated_at' => $row->updated_at ?? now(),
                    ];
                }

                if (!empty($payload)) {
                    DB::table('users')->upsert(
                        $payload,
                        ['email'],
                        ['name', 'password', 'role', 'status', 'updated_at']
                    );
                }
            });
    }
};
