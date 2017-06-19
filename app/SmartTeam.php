<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmartTeam extends Model
{
    protected $table = 'smartteam';

    public function ppd()
    {
        return $this->belongsTo('App\PPD', 'kod_ppd', 'kod_ppd');
    }

    public function ketua()
    {
        return $this->belongsTo('App\User', 'ketua_kumpulan', 'id');
    }

    public function getAhliAttribute()
    {
        $ahli = explode(',', trim($this->senarai_jtk,','));
        return $ahli;
    }

    public function aktiviti()
    {
        return $this->hasMany('App\AktivitiSmartTeam', 'smart_team_id', 'id')->orderBy('id','DESC');
    }

    public function getJumlahAhliAttribute()
    {
        return count(explode(',', trim($this->senarai_jtk,',')));
    }
}
