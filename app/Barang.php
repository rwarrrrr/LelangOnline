<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //ini nama table
    protected $table = 'tb_barang';
    //ini primaryKey
    protected $primaryKey = 'id_barang';
    //ini nama field
    protected $fillable = [
    	'nama_barang','tgl','harga_awal','deskripsi_barang'
    ];


    //ini buat relasi ke tabel lelang / model lelang
    //hasOne namanya relasi one to one dari 1 field cuman bisa ada 1 data
	public function lelang() {
    	return $this->hasOne('App\Lelang','id_barang','id_barang');
    }

}
