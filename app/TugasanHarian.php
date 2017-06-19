<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TugasanHarian extends Model
{
    protected $table = 'tugasan_harian';

    public function getTarikhSemakanFormattedAttribute()
	{
	    $date = $this->tarikh_semakan;
	    if (strlen($date) != 0) {
	    	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
	    } else {
	    	return '-';
		}
	}

    public function getTarikhPpdSemakFormattedAttribute()
	{
	    $date = $this->tarikh_ppd_semak;
	    if (strlen($date) != 0) {
	    	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
	    } else {
	    	return '-';
		}
	}

	public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
