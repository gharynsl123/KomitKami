<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $guarded = [];

    public function transactions() {
        return $this->hasMany('App\Transaction', 'inventory_id');
    }

}
