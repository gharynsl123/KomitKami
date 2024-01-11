<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $guarded = [];

    function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
    function stok() {
        return $this->belongsTo('App\Stok', 'id_stok');
    }
}
