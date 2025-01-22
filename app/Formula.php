<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = 'formula';
    protected $guarded = [];

    function product() {
        return $this->belongsTo('App\Product', 'product_id');
    }
    function inventory() {
        return $this->belongsTo('App\Inventory', 'inventory_id');
    }
}
