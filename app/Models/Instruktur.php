<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use HasFactory;
    protected $table = 'instruktur';
    public $timestamps = false;
    protected $primaryKey = 'id_instruktur';


    protected $fillable = [
        'id_instruktur',
        'nama_instruktur',
        'alamat_instruktur',
        'tgl_lahir_instruktur',
        'email_instruktur',
        'no_telp_instruktur',
        'status_instruktur',
        'jumlah_hadir_instruktur',
        'jumlah_libur_instruktur',
        'jumlah_terlambat_instruktur',
    ];
}
