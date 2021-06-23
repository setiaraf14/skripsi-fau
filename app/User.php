<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Berita;
use App\Models\Ratings;

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

    public function rt(){
        return $this->belongsTo('App\Models\Rt','rt_id','id');
    }

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'rw_id', 'id');
    }

    public function berita()
    {
        return $this->hasMany(Berita::class, 'user_id', 'id');
    }

    public function rating()
    {
        return $this->hasOne(Ratings::class, 'user_id');
    }
}
