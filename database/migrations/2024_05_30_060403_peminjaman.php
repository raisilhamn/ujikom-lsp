<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('kode_pinjam');
            $table->foreignId('id_peminjam')->constrained('peminjam', 'id_peminjam');
            $table->foreignId('id_admin')->nullable()->constrained('admin', 'id_admin');
            $table->date('tgl_pesan');
            $table->date('tgl_ambil')->nullable();
            $table->date('tgl_wajibkembali')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('status_peminjaman');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
