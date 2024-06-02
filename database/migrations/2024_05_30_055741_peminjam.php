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
        Schema::create('peminjam', function (Blueprint $table) {
            $table->id('id_peminjam');
            $table->string('nama_peminjam');
            $table->date('tgl_daftar');
            $table->string('user_peminjam')->unique();
            $table->string('password_peminjam');
            $table->string('foto_peminjam');
            $table->boolean('status_peminjam')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjam');
    }
};
