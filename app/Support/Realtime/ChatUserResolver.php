<?php

namespace App\Support\Realtime;

use App\Models\Admin;
use App\Models\CustomerUser;
use App\Models\StaffMember;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChatUserResolver
{
    public static function forAuthenticated(): ?User
    {
        $authUser = getAuthenticatedUser();

        if (!$authUser instanceof Authenticatable) {
            return null;
        }

        return self::fromAuthenticatable($authUser);
    }

    public static function fromAuthenticatable(Authenticatable $authUser): User
    {
        if ($authUser instanceof User) {
            return $authUser;
        }

        $role = self::detectRole($authUser);
        $email = self::attribute($authUser, 'email');
        $name = self::attribute($authUser, 'name', 'User');
        $password = self::attribute($authUser, 'password');

        if (!$email) {
            $email = Str::lower($role . '.' . $authUser->getAuthIdentifier() . '@automate.local');
        }

        return User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'role' => $role,
                'password' => $password ?: Hash::make(Str::random(40)),
            ]
        );
    }

    private static function attribute(Authenticatable $authUser, string $key, mixed $default = null): mixed
    {
        if (method_exists($authUser, 'getAttribute')) {
            $value = $authUser->getAttribute($key);

            return $value !== null ? $value : $default;
        }

        /** @var mixed $mixedUser */
        $mixedUser = $authUser;

        if (is_object($mixedUser) && isset($mixedUser->{$key})) {
            return $mixedUser->{$key};
        }

        return $default;
    }

    public static function detectRole(Authenticatable $authUser): string
    {
        if ($authUser instanceof Admin) {
            return 'admin';
        }

        if ($authUser instanceof StaffMember) {
            return 'staff';
        }

        if ($authUser instanceof CustomerUser) {
            return 'customer';
        }

        return $authUser->role ?? (getAuthenticatedUserRole() ?? 'customer');
    }
}
