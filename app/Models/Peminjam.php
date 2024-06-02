<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Peminjam extends Authenticatable
{
    use HasFactory;
    protected $table = 'peminjam';
    // set kode peminjam as primary key
    protected $primaryKey = 'id_peminjam';

    // fillable
    protected $fillable = [
        'kode_peminjam', // add this line
        'nama_peminjam',
        'tgl_daftar',
        'user_peminjam',
        'password_peminjam',
        'foto_peminjam',
        'status_peminjam',
    ];

    // relationship
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_peminjam', 'id_peminjam');
    }

}
