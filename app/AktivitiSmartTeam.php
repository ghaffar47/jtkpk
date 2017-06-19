<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AktivitiSmartTeam extends Model
{
    protected $table = 'aktiviti_smartteam';

    public function setTarikhDariAttribute($value)
    {
    	$this->attributes['tarikh_dari'] = \Carbon\Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function setTarikhHinggaAttribute($value)
    {
    	$this->attributes['tarikh_hingga'] = \Carbon\Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function getTarikhDariFormattedAttribute()
	{
	    $date = $this->tarikh_dari;
	    if (strlen($date) != 0) {
	    	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
	    } else {
	    	return '-';
		}
	}

	public function getTarikhHinggaFormattedAttribute()
	{
	    $date = $this->tarikh_hingga;
		if (strlen($date) != 0) {
	    	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
	    } else {
	    	return '-';
		}
	}

}
