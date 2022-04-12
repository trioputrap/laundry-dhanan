<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Intervention\Image\ImageManagerStatic as Image;

class Pegawai extends Authenticatable
{
    use Notifiable;

    public static $dir_photo = "/uploads/profiles/";
    protected $table = 'tb_pegawai';
    protected $primaryKey = 'id_pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_pegawai',
        'nohp', 
        'alamat', 
        'password', 
        'email',
        'profil',
    ];

    public function getProfilPath(){
        if($this->profil != null && $this->profil != ''){
            return asset(Pegawai::$dir_photo . $this->profil);
        }
    }

    public function uploadPhoto($file, $filename){
        $destinationPath = public_path(Pegawai::$dir_photo);
        $img = Image::make($file);
        $img->resize(null, 800, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath. '/'. $filename);
        $this->save();
    }
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
}
