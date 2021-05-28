<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Rt()
    {
        return $this->belongsTo(Rt::class, 'rt_id', 'id');
    }

    public function Rw()
    {
        return $this->belongsTo(Rt::class, 'rw_id', 'id');
    }

    public function Role()
    {
        return $this->belongsTo(Role::class, 'role_user_id', 'id');
    }
}
