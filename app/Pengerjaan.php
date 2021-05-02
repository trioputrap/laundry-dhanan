<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengerjaan extends Model
{
    protected $table = 'tb_pengerjaan';
    protected $primaryKey = 'id_pengerjaan';
    public $timestamps = false;
    
    protected $fillable = [
        'id_konsumen', 
        'id_layanan', 
        'jumlah', 
        'harga', 
        'total_harga', 
        'status', 
        'tanggal', 
    ];

    public function konsumen()
    {
        return $this->belongsTo('App\Konsumen', 'id_konsumen');
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'id_pegawai');
    }

    public function layanan()
    {
        return $this->belongsTo('App\Layanan', 'id_layanan');
    }
}
