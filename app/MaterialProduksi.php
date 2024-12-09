<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialProduksi extends Model
{
    protected $table = 'permintaan_material';
    protected $guarded = [];

    function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    function formula() {
        return $this->belongsTo('App\Formula', 'formula_id');
    }
    function produksi() {
        return $this->belongsTo('App\Produksi', 'produksi_id');
    }
}
