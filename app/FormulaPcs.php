<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormulaPcs extends Model
{
    protected $table = 'formula_pcs';
    protected $guarded = [];

    public function product() {
        $this->belongsTo('App\Product', 'product_id');
    }
    public function inventory() {
        $this->belongsTo('App\Inventory', 'inventory_id');
    }
    public function formula() {
        $this->belongsTo('App\Formula', 'formula_id');
    }
}
