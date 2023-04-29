<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promo extends Model
{
    use HasFactory;

    public static function getPromo()
    {
        return DB::select("select * from promo where status_promo = 1");
    }
}
