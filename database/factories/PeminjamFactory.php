<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjam>
 */
use Illuminate\Support\Facades\Hash;

class PeminjamFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // *
        //         'nama_peminjam',
        // 'tgl_daftar',
        // 'user_peminjam',
        // 'password_peminjam',
        // 'foto_peminjam',
        // 'status_peminjam',
//*
        return [
            'nama_peminjam' => $this->faker->name(),
            'tgl_daftar' => $this->faker->date(),
            'user_peminjam' => $this->faker->unique()->userName(),
            'password_peminjam' => static::$password ??= Hash::make('password'),
            'foto_peminjam' => "",
            'status_peminjam' => $this->faker->boolean(),
        ];
    }
}
