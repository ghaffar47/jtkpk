<?php

use Illuminate\Database\Seeder;

class RolesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        DB::table('roles')->insert(['role' => 'super-admin', 'role_name' => 'Pentadbir Tertinggi']);
        DB::table('roles')->insert(['role' => 'admin', 'role_name' => 'Pentadbir']);
        DB::table('roles')->insert(['role' => 'monitor', 'role_name' => 'Pemerhati (Lihat Sahaja)']);
        DB::table('roles')->insert(['role' => 'jpn', 'role_name' => 'Jabatan Pendidikan Negeri (JPN)']);
        DB::table('roles')->insert(['role' => 'ppd', 'role_name' => 'Pejabat Pendidikan Daerah (PPD)']);
        DB::table('roles')->insert(['role' => 'leader', 'role_name' => 'Penghulu/Penghuluwati']);
    }
}
