<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    public function users()
    {
    	return $this->belongsToMany('App\User', 'user_roles', 'user_id', 'role_id');
    }
}
