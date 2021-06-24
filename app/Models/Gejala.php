<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gejala extends Model
{
    protected $table = 'gejala';

    protected $fillable = ['kode_gejala', 'kategori', 'nama_gejala'];

}
