<?php

use Illuminate\Database\Seeder;

class PPDDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PEJABAT PENDIDIKAN DAERAH
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A010', 'website' => 'http://jpnperak.moe.gov.my/ppdbatangpadang', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH BATANG PADANG']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A020', 'website' => 'http://jpnperak.moe.gov.my/ppdmanjung', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH MANJUNG']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A040', 'website' => 'http://jpnperak.moe.gov.my/ppdkerian', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH KRIAN']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A050', 'website' => 'http://jpnperak.moe.gov.my/ppdkualakangsar', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH KUALA KANGSAR']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A060', 'website' => 'http://jpnperak.moe.gov.my/ppdhilirperak', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH HILIR PERAK']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A070', 'website' => 'http://jpnperak.moe.gov.my/ppdlms', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH LARUT/MATANG/SELAMA']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A080', 'website' => 'http://jpnperak.moe.gov.my/ppdhuluperak', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH HULU PERAK']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A090', 'website' => 'http://jpnperak.moe.gov.my/ppdperaktengah', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH PERAK TENGAH']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A100', 'website' => 'http://jpnperak.moe.gov.my/ppdkinta', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH KINTA UTARA']);
        DB::table('ppd')->insert(['kod_jpn' => '08', 'kod_ppd' => 'A110', 'website' => 'http://jpnperak.moe.gov.my/ppdks', 'ppd' => 'PEJABAT PENDIDIKAN DAERAH KINTA SELATAN']);
    }
}
