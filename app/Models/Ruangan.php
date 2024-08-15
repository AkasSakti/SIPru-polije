<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'kapasitas',
        'start_pinjam',
        'end_pinjam',
        'verifikasi',
    ];

    protected $casts = [
        'start_pinjam' => 'datetime',
        'end_pinjam' => 'datetime',
    ];
}
