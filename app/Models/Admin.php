<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'nama_admin',
        'user_admin',
        'pass_admin',
    ];

    public function getAuthPassword()
    {
        return $this->pass_admin;
    }

    public function Peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_admin', 'id_admin');
    }
}
