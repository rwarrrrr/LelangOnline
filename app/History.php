<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    //ini nama table
    protected $table = 'history_lelang';
    //ini primaryKey
    protected $primaryKey = 'id_history';
    //ini nama field
    protected $fillable = [
    	'id_lelang','id_barang','id_user','penawaran_harga'
    ];


    //ini buat relasi ke tabel lelang / model lelang
    //hasOne namanya relasi one to one dari 1 field cuman bisa ada 1 field lagi
    public function lelang() {
    	return $this->hasOne('App\Lelang','id_lelang','id_lelang');
    }

    //ini buat relasi ke tabel barang / model barang
    //hasOne namanya relasi one to one dari 1 field cuman bisa ada 1 data
    public function barang() {
    	return $this->hasOne('App\Barang','id_barang','id_barang');
    }

    //ini buat relasi ke tabel masyarakat / model masyarakat
    //hasMany buat relasi one to many yang artinya 1 field bisa banyak data 
    //hasMany bisa buat relassi many to many jadi banyak data atau field bisa dimasukin banyak data juga
	public function masyarakat() {
    	return $this->hasMany('App\Masyarakat','id_user','id_user');
    }

}
