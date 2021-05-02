<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'tb_layanan';
    protected $primaryKey = 'id_layanan';
    public $timestamps = false;

    protected $fillable = [
        'jenis_layanan', 
        'harga', 
    ];
}
