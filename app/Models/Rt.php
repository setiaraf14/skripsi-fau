<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Rt extends Model
{
    protected $table = 'rts';

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany('App\User', 'rt_id', 'id');
    }

    public function permohonanktp()
    {
        return $this->hasMany('App\Models\PermohonanKtp', 'rt_id', 'id');
    }

    public function permohonanKk()
    {
        return $this->hasMany('App\Models\PermohonanKk', 'rt_id', 'id');
    }
}
