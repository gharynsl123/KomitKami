<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $guarded = [];

    public function inventory() {
        return $this->belongsTo('App\Inventory', 'inventory_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function tiket() {
        return $this->belongsTo('App\MaterialProduksi', 'id_tiket');
    }

}
