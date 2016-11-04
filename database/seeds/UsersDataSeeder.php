<?php

use Illuminate\Database\Seeder;

class UsersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin User
        DB::table('users')->insert(
            [
                'name' => 'Pentadbir Sistem',
                'email' => 'admin@domain.com',
                'password' => '$2y$10$VzArNThE8p3lScLDKdjfj.C0cemY9IJmmYgXUgP8TTdUseMqR.lry',
                'remember_token' => DB::raw('NULL'),
                'role' => 'super-admin',
                'gred' => DB::raw('NULL'),
                'kod_jpn' => DB::raw('NULL'),
                'kod_ppd' => DB::raw('NULL'),
                'kod_jabatan' => DB::raw('NULL'),
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
    }
}
