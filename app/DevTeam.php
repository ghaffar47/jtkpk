<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DevTeam extends Model
{
    protected $table = 'devteam';

    public function ppd()
    {
        return $this->belongsTo('App\PPD', 'kod_ppd', 'kod_ppd');
    }

    public function ketua()
    {
    	return $this->belongsTo('App\User', 'ketua_kumpulan', 'id');
    }

    public function projek()
    {
    	return $this->hasMany('App\Projek', 'devteam_id', 'id');
    }

	public function getJumlahAhliAttribute()
    {
        return count(explode(',', trim($this->senarai_jtk,',')));
    }
}
