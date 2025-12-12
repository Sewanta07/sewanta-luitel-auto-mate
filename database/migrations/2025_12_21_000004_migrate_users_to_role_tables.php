<?php

use App\Models\Admin;
use App\Models\CustomerUser;
use App\Models\StaffMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            return;
        }

        $users = DB::table('users')->select('*')->get();

        foreach ($users as $user) {
            $role = strtolower(trim($user->role ?? 'customer'));
            switch ($role) {
                case 'admin':
                    Admin::updateOrCreate(
                        ['email' => $user->email],
                        [
                            'name' => $user->name,
                            'password' => $user->password ?? Hash::make('password'),
                            'status' => $user->status ?? 'active',
                            'email_verified_at' => $user->email_verified_at,
                        ]
                    );
                    break;
                case 'staff':
                    StaffMember::updateOrCreate(
                        ['email' => $user->email],
                        [
                            'name' => $user->name,
                            'password' => $user->password ?? Hash::make('password'),
                            'status' => $user->status ?? 'pending',
                            'email_verified_at' => $user->email_verified_at,
                            'position' => $user->position ?? null,
                            'phone' => $user->phone ?? null,
                            'experience' => $user->experience ?? null,
                            'documents' => $user->documents ?? null,
                        ]
                    );
                    break;
                case 'customer':
                default:
                    CustomerUser::updateOrCreate(
                        ['email' => $user->email],
                        [
                            'name' => $user->name,
                            'password' => $user->password ?? Hash::make('password'),
                            'status' => $user->status ?? 'active',
                            'email_verified_at' => $user->email_verified_at,
                        ]
                    );
                    break;
            }
        }
    }

    public function down(): void
    {
        // No rollback of migrated data to the old users table.
    }
};

