<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $guarded = [];

    function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
    function instansi() {
        return $this->belongsTo('App\Instansi', 'instansi_id');
    }
}
