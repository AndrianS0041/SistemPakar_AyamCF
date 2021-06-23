<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "users";

    protected $fillable = ['name','password'];

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function barang()
    {
        return $this->hasOne('App\Barang','id_pelanggan');
    }

    public function plgteknisi()
    {
        return $this->hasOne('App\Teknisi', 'id_pelanggan');
    }

    public function plgnota()
    {
        return $this->hasOne('App\Nota', 'id_pelanggan');
    }
 
}
