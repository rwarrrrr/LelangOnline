<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    //ini nama table
    protected $table = 'tb_lelang';
    //ini primaryKey
    protected $primaryKey = 'id_lelang';
    //ini nama field
    protected $fillable = [
    	'id_barang','tgl_lelang','harga_akhir','id_user','id_petugas','status'
    ];


    //ini buat relasi ke tabel barang / model barang
    //hasOne namanya relasi one to one dari 1 field cuman bisa ada 1 field lagi
    public function barang() {
    	return $this->hasOne('App\Barang','id_barang','id_barang');
    }

    //ini buat relasi ke tabel masyarakat / model masyarakat
    //hasOne namanya relasi one to one dari 1 field cuman bisa ada 1 field lagi
    public function masyarakat() {
    	return $this->hasOne('App\Masyarakat','id_user','id_user');
    }

    //ini buat relasi ke tabel petugass / model petugass
    //hasOne namanya relasi one to one dari 1 field cuman bisa ada 1 field lagi
    public function petugas() {
    	return $this->hasOne('App\Petugas','id_petugas','id_petugas');
    }

}
