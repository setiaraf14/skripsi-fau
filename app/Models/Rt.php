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
        return $this->hasMany(User::class, 'rt_id', 'id');
    }
}
