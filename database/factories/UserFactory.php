<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Core\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'user_name' => fake()->name(),
            'user_email' => fake()->unique()->safeEmail(),
            'user_password' => Hash::make('password'),
            'user_psalt' => Str::random(32),
            'user_active' => 1,
            'user_type' => 1,
            'user_company' => null,
            'user_language' => 'en',
            'user_passwordreset_token' => null,
        ];
    }
}
