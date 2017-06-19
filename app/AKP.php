<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AKP extends Model
{
    protected $table = 'aduan_kerosakan';

    public function getTarikhAduanFormattedAttribute()
	{
	    $date = $this->tarikh_aduan;
	    if (strlen($date) != 0) {
	    	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
	    } else {
	    	return '';
		}
	}

    public function getTarikhPemeriksaanFormattedAttribute()
	{
	    $date = $this->tarikh_pemeriksaan;
	    if (strlen($date) != 0) {
	    	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
	    } else {
	    	return '';
		}
	}

    public function getTarikhSelesaiFormattedAttribute()
	{
	    $date = $this->tarikh_selesai;
	    if (strlen($date) != 0) {
	    	return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
	    } else {
	    	return '';
		}
	}

	public function getNoSiriAkpAttribute()
	{
		$user_id = $this->user_id;
		$usr = \App\User::find($user_id);

		$no_siri = str_pad($this->no_siri_aduan,4,'0',STR_PAD_LEFT);
		$ta = explode('-', $this->tarikh_aduan);
		$ta_year = $ta[0];
		$ta_mon = $ta[1];
		$ta_day = $ta[2];

		return "AKP/ICT/".$usr->kod_jabatan."/".$ta_year."/".$no_siri;
	}

	public function getStatusAduanViewAttribute()
	{
		if (strlen($this->status_aduan) > 0) {
			return ucwords(strtolower($this->status_aduan));
		} else {
			return "-";
		}
	}

	public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
