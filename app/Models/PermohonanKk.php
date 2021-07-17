<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanKk extends Model
{
    protected $table = 'permohonan_kk';
    protected $guarded = [];

    public function rt(){
        return $this->belongsTo('App\Models\Rt','rt_id','id');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }
}
