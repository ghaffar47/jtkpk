<?php

use Illuminate\Database\Seeder;

class SenaraiSemakanDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('senarai_semakan')->insert(
            [
                'id' => 1,
                'user_id' => 0,
                'perkara' => 'Semakan Capaian Internet 1BestariNet',
                'cara_pengujian' => 'http://www.speedtest.net atau http://speedtest.ytlcomms.my',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('senarai_semakan')->insert(
            [
                'id' => 2,
                'user_id' => 0,
                'perkara' => 'Capaian Laman Rasmi Kementerian Pendidikan Malaysia (KPM)',
                'cara_pengujian' => 'http://www.moe.gov.my',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('senarai_semakan')->insert(
            [
                'id' => 3,
                'user_id' => 0,
                'perkara' => 'Capaian Laman Rasmi Jabatan Pendidikan Perak (JPN)',
                'cara_pengujian' => 'http://jpnperak.moe.gov.my',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('senarai_semakan')->insert(
            [
                'id' => 4,
                'user_id' => 0,
                'perkara' => 'Capaian Laman Rasmi Pejabat Pendidikan Daerah (PPD)',
                'cara_pengujian' => 'http://jpnperak.moe.gov.my/#PPD#',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('senarai_semakan')->insert(
            [
                'id' => 5,
                'user_id' => 0,
                'perkara' => 'Capaian Laman VLE Frog Sekolah',
                'cara_pengujian' => 'https://#KOD_SEKOLAH#.1bestarinet.net',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('senarai_semakan')->insert(
            [
                'id' => 6,
                'user_id' => 0,
                'perkara' => 'Capaian Laman Aplikasi Pengurusan Data Murid (APDM)',
                'cara_pengujian' => 'https://apdm.moe.gov.my/',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('senarai_semakan')->insert(
            [
                'id' => 7,
                'user_id' => 0,
                'perkara' => 'Membuat semakan e-mel rasmi sekolah 1GOVUC',
                'cara_pengujian' => 'https://webmail.1govuc.gov.my/',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
    }
}
