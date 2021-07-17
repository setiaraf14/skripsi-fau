<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanKtp extends Model
{
    protected $table = 'permohonan_ktp';
    protected $guarded = [];

    public function rt(){
        return $this->belongsTo('App\Models\Rt','rt_id','id');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }
}
