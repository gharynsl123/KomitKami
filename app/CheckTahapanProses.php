<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckTahapanProses extends Model
{
    protected $table = 'check_tahapan_proses';
    protected $guarded = [];

    public function tapahanProses() {
        return $this->belongsTo('App\TahapanProses', 'tahapan_id');
    }

    public function produksi() {
        return $this->belongsTo('App\Produksi', 'produksi_id');
    }
}
