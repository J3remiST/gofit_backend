<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalUmum extends Model
{
    use HasFactory;
    protected $table = 'jadwal_umum';
    public $timestamps = false;
    public $primaryKey = 'id_jadwal_umum';

    protected $fillable = [
        'id_jadwal_umum',
        'id_instruktur',
        'id_kelas',
        'hari_jadwal_umum',
        'sesi_jadwal_umum',
        'status_jadwal_umum',
        'tgl_jadwal_umum',
        
    ];
}
