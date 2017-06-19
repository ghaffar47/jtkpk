<?php

use Illuminate\Database\Seeder;

class PKGDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PEJABAT PKG
        DB::table('pkg')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A020', 'kod_pkg' => 'AQA1001', 'pkg' => 'PKG SITIAWAN', 'website' => 'http://btpnperak.moe.edu.my/pkgsitiawan']);
        DB::table('pkg')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A020', 'kod_pkg' => 'AQA1002', 'pkg' => 'PKG PANTAI REMIS', 'website' => 'http://btpnperak.moe.edu.my/pkgpantairemis']);
        DB::table('pkg')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A020', 'kod_pkg' => 'AQA1003', 'pkg' => 'PKG AYER TAWAR', 'website' => 'http://btpnperak.moe.edu.my/pkgayertawar']);
        DB::table('pkg')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A020', 'kod_pkg' => 'AQA1004', 'pkg' => 'PKG BERUAS', 'website' => 'http://btpnperak.moe.edu.my/pkgberuas']);
        DB::table('pkg')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A020', 'kod_pkg' => 'AQA1005', 'pkg' => 'PKG SERI MANJUNG', 'website' => 'http://btpnperak.moe.edu.my/pkgserimanjung']);
    }
}
