<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->hasOne('App\Roles', 'role', 'role');
    }
    public function greds()
    {
        return $this->hasOne('App\Gred', 'id', 'gred');
    }

    public function jabatan()
    {
        return $this->hasOne('App\Sekolah', 'kod_sekolah', 'kod_jabatan');
    }
}
