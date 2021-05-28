<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $table = 'role-user';

    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(user::class, 'role_user_id', 'id');
    }
}
