<?php

namespace Modules\Core\src\Libraries;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Crypt
{
    /**
     * Generate a random salt for password hashing.
     */
    public function salt(): string
    {
        return Str::random(32);
    }

    /**
     * Generate a hashed password using the provided salt.
     */
    public function generate_password(string $password, string $salt): string
    {
        return Hash::make($password . $salt);
    }

    /**
     * Check if the provided password matches the hashed password.
     */
    public function check_password(string $hash, string $password): bool
    {
        return Hash::check($password, $hash);
    }
}
