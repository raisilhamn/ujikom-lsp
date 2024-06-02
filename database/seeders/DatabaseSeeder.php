<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Buku::factory(50)->create();
        \App\Models\Peminjam::factory(10)->create();
        \App\Models\Admin::factory(10)->create();
        \App\Models\Admin::factory()->create([
            'user_admin' => 'test',
            'pass_admin' => static::$password ??= Hash::make('password'),
        ]);

        \App\Models\Peminjam::factory()->create([
            'user_peminjam' => 'test',
            'password_peminjam' => static::$password ??= Hash::make('password'),
        ]);

        \App\Models\Peminjaman::factory(5)->create();
        \App\Models\DetailPeminjaman::factory(20)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }}
