<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PPD extends Model
{
    protected $table = 'ppd';

    public function devteam()
    {
    	return $this->hasMany('App\DevTeam', 'kod_ppd', 'kod_ppd');
    }
}
