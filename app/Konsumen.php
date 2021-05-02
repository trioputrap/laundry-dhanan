<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'tb_konsumen';
    protected $primaryKey = 'id_konsumen';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username', 
        'password', 
        'nohp', 
        'alamat', 
    ];
}
