<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Peminjaman>
 */
class PeminjamanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // count of $peminjam
        $peminjam = \App\Models\Peminjam::count();
        $admin = \App\Models\Admin::count();
        return [
            'id_peminjam' => $this->faker->randomElement(range(1, $peminjam)),
            'id_admin' => $this->faker->randomElement(range(1, $admin)),
            'tgl_pesan' => $this->faker->date(),
            'tgl_ambil' => $this->faker->date(),
            'tgl_wajibkembali' => $this->faker->date(),
            'tgl_kembali' => $this->faker->date(),
            'status_peminjaman' => $this->faker->randomElement(['diproses', 'disetujui', 'ditolak', 'selesai']),
        ];
    }
}
