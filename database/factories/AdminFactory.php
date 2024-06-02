<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_admin' => $this->faker->name(),
            'user_admin' => $this->faker->unique()->userName(),
            'pass_admin' => static::$password ??= Hash::make('password'),
        ];
    }
}
