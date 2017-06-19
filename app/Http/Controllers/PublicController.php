<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

use App\User;
use App\Sekolah;

class PublicController extends Controller
{
    protected $req;

    public function __construct(Request $r)
    {
        $this->req = $r;
    }

	public function replaceDay($day) {
        $day = strtolower($day);
        if ($day == 'monday') {
            return 'Isnin';
        } else if ($day == 'tuesday') {
            return 'Selasa';
        } else if ($day == 'wednesday') {
            return 'Rabu';
        } else if ($day == 'thursday') {
            return 'Khamis';
        } else if ($day == 'friday') {
            return 'Jumaat';
        } else if ($day == 'saturday') {
            return 'Sabtu';
        } else {
            return 'Ahad';
        }
    }

    public function replaceMonth($MonthNo) {
        $MonthNo = intval($MonthNo);
        
        if ($MonthNo == 1) {
            $ret = "Januari";
        } else if ($MonthNo == 2) {
            $ret = "Februari";
        } else if ($MonthNo == 3) {
            $ret = "Mac";
        } else if ($MonthNo == 4) {
            $ret = "April";
        } else if ($MonthNo == 5) {
            $ret = "Mei";
        } else if ($MonthNo == 6) {
            $ret = "Jun";
        } else if ($MonthNo == 7) {
            $ret = "Julai";
        } else if ($MonthNo == 8) {
            $ret = "Ogos";
        } else if ($MonthNo == 9) {
            $ret = "September";
        } else if ($MonthNo == 10) {
            $ret = "Oktober";
        } else if ($MonthNo == 11) {
            $ret = "November";
        } else if ($MonthNo == 12) {
            $ret = "Disember";
        }
        return $ret;
    }

    public function countDays($year, $month, $ignore) {
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }
        return $count;
    }

    //---------------------------------------------

    public function LaporanSpeedtest($kod_sekolah, $month=null, $year=null)
    {
        $sekolah = Sekolah::where('kod_sekolah',$kod_sekolah)->first();
        $user = User::where('kod_jabatan',$kod_sekolah)->first();

        $nama_sekolah = $sekolah->nama_sekolah;
        $user_id = $user->id;

        if ($month == '0') {
            $bulan = '';
            $bulan_tahun = $year;
        } else {
            $bulan = $this->replaceMonth($month);
            $bulan_tahun = $this->replaceMonth($month).', '.$year;
        }

        return view('jtk.laporan-speedtest-public',[
            'nama_sekolah' => $nama_sekolah,
            'kod_sekolah' => $kod_sekolah,
            'bulan_tahun' => $bulan_tahun,
            'month' => $month,
            'year' => $year,
            'user_id' => $user_id
        ]);
    }
}
