<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $guarded = [];


    function instansi() {
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }
}
