<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalHarian extends Model
{
    use HasFactory;
    protected $table = 'jadwal_harian';
    public $timestamps = false;
    protected $primaryKey = 'id_jadwal_harian';

    protected $fillable = [
        'id_jadwal_harian',
        'hari_jadwal_harian',
        'sesi_jadwal_harian',
        'tgl_jadwal_harian',
        'id_instruktur',
        'instruktur_pengganti',
        'id_kelas'
    ];
}
  