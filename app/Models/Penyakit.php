<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    protected $table = 'penyakit';

    protected $fillable = ['kode_penyakit', 'nama_penyakit', 'detail', 'saran', 'gambar'];

}
