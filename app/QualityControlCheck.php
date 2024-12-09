<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualityControlCheck extends Model
{
    protected $table = 'pemeriksaan_quality_control';
    protected $guarded = [];
    
    public function produksi() {
        return $this->belongsTo('App\Produksi', 'produksi_id');
    }

    public function quality() {
        return $this->belongsTo('App\QualityControl', 'quality_id');
    }
}
