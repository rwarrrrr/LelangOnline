<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    //ini nama table
    protected $table = 'tb_level';
    //ini primaryKey
    protected $primaryKey = 'id_level';
    //ini nama field
    protected $fillable = [
    	'level'
    ];
}
