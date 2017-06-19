<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projek extends Model
{
    protected $table = 'projek';

    public function devteam()
    {
    	return $this->belongsTo('App\DevTeam', 'devteam_id', 'id');
    }

    public function tasks()
    {
    	return $this->hasMany('App\ProjekTask', 'projek_id', 'id');
    }

    public function getPeratusSiapAttribute()
    {
    	if ($this->tasks->count() != 0) {
    		$peratus_siap = (($this->tasks->sum('peratus_siap') / ($this->tasks->count()*100)) * 100);
    		$peratus_siap = number_format($peratus_siap,2);
    	} else {
    		$peratus_siap = number_format(0,2);
    	}
    	return $peratus_siap;
    }
}
