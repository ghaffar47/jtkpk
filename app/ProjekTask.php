<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjekTask extends Model
{
    protected $table = 'projek_task';

    public function jtk()
    {
    	return $this->belongsTo('App\User', 'assigned', 'id');
    }

    public function timeline()
    {
    	return $this->hasMany('App\ProjekTaskDetail', 'task_id', 'id');
    }

    public function getCreatedAtFormattedAttribute()
	{
		$date = $this->created_at;
	    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y h:i A');
	}

	public function getUpdatedAtFormattedAttribute()
	{
	    $date = $this->updated_at;
	    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y h:i A');
	}

	public function getNicetimeUAttribute()
	{
		$date = $this->updated_at;

		if (empty($date)) {
			return "-";
		}

		$periods = array("saat", "minit", "jam", "hari", "minggu", "bulan", "tahun", "dekat");
		$atense = "lepas";
		$lengths = array("60","60","24","7","4.35","12","10");
		$now = time();
		$unix_date = strtotime($date);

		// check validity of date
		if (empty($unix_date)) {   
			return "-";
		}

		// is it future date or past date
		if ($now > $unix_date) {   
			$difference = $now - $unix_date;
			$tense = $atense;
		} else {
			$difference = $unix_date - $now;
			$tense = "";
		}

		for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if ($difference != 1) {
			$periods[$j].= "";
		}

		if ($periods[$j] == "saat" || $periods[$j] == "seconds") {
			if ($difference < 5) {
				return "Sebentar tadi";
			} else {
				return "$difference $periods[$j] {$tense}";
			}
		} else {
			return "$difference $periods[$j] {$tense}";
		}
	}
}
