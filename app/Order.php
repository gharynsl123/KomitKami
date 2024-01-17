<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    protected $guarded = [];
    
    function brand() {
        return $this->belongsTo('App\Brand', 'brand_id');
    }

    function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
    
    function instansi() {
        return $this->belongsTo('App\Instansi', 'id_instansi');
    }
}
