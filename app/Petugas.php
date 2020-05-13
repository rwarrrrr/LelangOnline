<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    //ini nama table
    protected $table = 'tb_petugas';
    //ini primaryKey
    protected $primaryKey = 'id_petugas';
    //ini nama field
    protected $fillable = [
    	'nama_petugas','username','password','id_level'
    ];

    //ini buat relasi ke tabel level / model level
    //hasOne namanya relasi one to one dari 1 field cuman bisa ada 1 field lagi
    public function level() {
    	return $this->hasOne('App\Level','id_level','id_level');
    }

    //walaupun ga ada id_lelang ini buat jaga jaga
    //ini buat relasi ke tabel lelang / model lelang
    //hasMany buat relasi one to many yang artinya 1 field bisa banyak data 
    //hasMany bisa buat relassi many to many jadi banyak data atau field bisa dimasukin banyak data juga
    public function lelang() {
        return $this->hasMany('App\Lelang','id_lelang','id_lelang');
    }

}
