<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $guarded = [];

    function invoice() {
        return $this->belongsTo('App\Invoice', 'invoice_id');
    }
}
