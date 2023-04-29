<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member';
    public $timestamps = false;
    protected $primaryKey = 'id_member';

    protected $fillable = [
        'id_member',
        'nama_member',
        'alamat_member',
        'tgl_lahir_member',
        'email_member',
        'no_telp_member',
        'status_member',
        'sisa_deposit_member',
    ];
}
