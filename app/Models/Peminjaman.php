<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\DetailPeminjaman;
use App\Models\Peminjam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'kode_pinjam';

    protected $fillable = [
        'kode_pinjam',
        'id_peminjam',
        'id_admin',
        'tgl_pesan',
        'tgl_ambil',
        'tgl_wajibkembali',
        'tgl_kembali',
        'status_peminjaman',
    ];

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'id_peminjam', 'id_peminjam');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function detail_peminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'kode_pinjam', 'kode_pinjam');
    }
}
