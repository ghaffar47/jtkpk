<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    public function getNamaSekolahDetailAttribute()
    {
    	return $this->kod_sekolah . ' - ' . $this->nama_sekolah;
    }
}
