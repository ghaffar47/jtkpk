<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* User Roles */
    public function roles() {
        return $this->belongsToMany('App\Roles', 'user_roles', 'user_id', 'role_id');
    }
    public function hasRole($name) {
        return in_array($name, array_pluck($this->roles->toArray(), 'role'));
    }
    public function addRole($name) {
        if (!$this->hasRole($name)) {
            $role = \App\Roles::where('role', '=', $name)->first();
            $this->roles()->attach($role->id);
        }
    }
    public function deleteRole($name) {
        if ($this->hasRole($name)) {
            $role = \App\Roles::where('role', '=', $name)->first();
            $this->roles()->detach($role->id);
        }
    }


    public function greds()
    {
        return $this->hasOne('App\Gred', 'id', 'gred');
    }

    public function jabatan()
    {
        return $this->hasOne('App\Sekolah', 'kod_sekolah', 'kod_jabatan');
    }

    public function TugasanHarian()
    {
        return $this->hasMany('App\TugasanHarian', 'user_id', 'id');
    }

    public function getDevteamAttribute()
    {
        $devteam = \App\DevTeam::where('kod_ppd',$this->kod_ppd)->where('senarai_jtk','LIKE','%,'.$this->id.',%')->first();
        
        if (count($devteam) != 0) {
            return $devteam->id;
        } else {
            return '0';
        }
    }

    public function getIsKetuaKumpulanAttribute()
    {
        $isKetua = \App\DevTeam::where('kod_ppd',$this->kod_ppd)->where('ketua_kumpulan','=',$this->id)->get();
        if (count($isKetua) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getNamaPpdAttribute()
    {
        $dppd = \App\PPD::where('kod_ppd',$this->kod_ppd)->first();
        return $dppd->ppd . " (".$this->kod_ppd.")";
    }

    public function getNamaPpdListAttribute()
    {
        $dppd = \App\PPD::where('kod_ppd',$this->kod_ppd)->first();
        return $dppd->ppd;
    }

    public function getWebPpdAttribute()
    {
        $dppd = \App\PPD::where('kod_ppd',$this->kod_ppd)->first();
        return $dppd->website;
    }

    public function getNamaJpnAttribute()
    {
        $djpn = \App\JPN::where('kod_jpn',$this->kod_jpn)->first();
        return $djpn->jpn . " (".$this->kod_jpn.")";
    }

    public function getNamaKjAttribute()
    {
        $jab = \App\Sekolah::where('kod_sekolah',$this->kod_jabatan)->first();
        return $jab->nama_kj;
    }

    public function getJawatanKjAttribute()
    {
        $jab = \App\Sekolah::where('kod_sekolah',$this->kod_jabatan)->first();
        return $jab->jawatan_kj;
    }

    public function getEmelKjAttribute()
    {
        $jab = \App\Sekolah::where('kod_sekolah',$this->kod_jabatan)->first();
        return $jab->emel_kj;
    }
    
    public function getPwdBNAttribute()
    {
        $jab = \App\Sekolah::where('kod_sekolah',$this->kod_jabatan)->first();
        return $jab->pwd_1bestarinet;
    }
}
