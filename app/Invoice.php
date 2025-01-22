<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $guarded = [];

    public function orders() {
        return $this->hasMany(Order::class, 'invoice_id', 'id');
    }
}