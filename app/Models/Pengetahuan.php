<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengetahuan extends Model
{
    use HasFactory;
    protected $table = 'basis_pengetahuan';

    protected $fillable = ['kode', 'id_penyakit', 'id_gejala', 'mb', 'md'];

    public function penyakit()
    {
        return $this->belongsTo('App\Models\Penyakit','id_penyakit','id');
    }

    public function gejala()
    {
        return $this->belongsTo('App\Models\Gejala','id_gejala','id');
    }
}

