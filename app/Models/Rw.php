<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Rw extends Model
{
    protected $table = 'rws';

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class, 'rw_id', 'id');
    }
}
