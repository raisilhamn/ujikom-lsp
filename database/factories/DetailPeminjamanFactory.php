<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPeminjaman>
 */
class DetailPeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // count buku
        $buku = \App\Models\Buku::count();
        $peminjaman = \App\Models\Peminjaman::count();
        return [
            'id_buku' => $this->faker->randomElement(range(1, $buku)),
            'kode_pinjam' => $this->faker->randomElement(range(1, $peminjaman)),
        ];
    }
}
