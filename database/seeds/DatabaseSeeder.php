<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesDataSeeder::class);
        $this->call(GredDataSeeder::class);
        $this->call(JPNDataSeeder::class);
        $this->call(PPDDataSeeder::class);
        $this->call(SekolahDataSeeder::class);
        $this->call(UsersDataSeeder::class);
    }
}
