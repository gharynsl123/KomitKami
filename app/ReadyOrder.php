<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadyOrder extends Model
{
    
    protected $table = "readyorder";
    protected $guarded = [];


    function order() {
        return $this->belongsTo('App\Order', 'order_id');
    }
    function user() {
        return $this->belongsTo('App\User', 'id_user');
    }

    function invoice() {
        return $this->belongsTo('App\Invoice', 'invoice_id');
    }
}
