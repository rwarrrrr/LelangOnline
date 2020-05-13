<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
	//ini nama table
    protected $table = 'tb_masyarakat';
    //ini primary key 
    protected $primaryKey = 'id_user';
    //ini nama field
    protected $fillable = [
    	'nama_lengkap','username','pass','telp'
    ];


    //walaupun ga ada id_lelang ini buat jaga jaga
    //ini buat relasi ke tabel lelang / model lelang
    //hasMany buat relasi one to many yang artinya 1 field bisa banyak data 
    //hasMany bisa buat relassi many to many jadi banyak data atau field bisa dimasukin banyak data juga
    public function lelang() {
    	return $this->hasMany('App\Lelang','id_user','id_user');
    }

    
}
