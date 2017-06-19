<?php

use Illuminate\Database\Seeder;

class KategoriKerosakanDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_kerosakan')->insert(
            [
                'id' => 1,
                'parent_id' => 0,
                'kategori' => 'Perkakasan',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('kategori_kerosakan')->insert(
            [
                'id' => 2,
                'parent_id' => 0,
                'kategori' => 'Perisian',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );
        DB::table('kategori_kerosakan')->insert(
            [
                'id' => 3,
                'parent_id' => 0,
                'kategori' => 'Projek EG',
                'created_at' => DB::raw('NOW()'),
                'updated_at' => DB::raw('NOW()')
            ]
        );

        # Perkakasan
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Komputer', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Monitor', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Keyboard', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Mouse', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Printer', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Scanner', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'CD/DVD ROM/RW', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'LCD Projektor', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Laptop', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Dongle YES', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Peralatan Rangkaian', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Server', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 1, 'kategori' => 'Lain-Lain', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);

        # Perisian
        DB::table('kategori_kerosakan')->insert(['parent_id' => 2, 'kategori' => 'OS (Windows)', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 2, 'kategori' => 'Microsoft Office', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 2, 'kategori' => 'Sistem / Aplikasi', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 2, 'kategori' => 'Antivirus', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 2, 'kategori' => 'Internet', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 2, 'kategori' => 'E-mail', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 2, 'kategori' => 'Lain-Lain', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);

        # Projek EG
        DB::table('kategori_kerosakan')->insert(['parent_id' => 3, 'kategori' => 'eSPKWS', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 3, 'kategori' => 'eSPKB', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 3, 'kategori' => 'Patskom', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
        DB::table('kategori_kerosakan')->insert(['parent_id' => 3, 'kategori' => 'Lain-Lain', 'created_at' => DB::raw('NOW()'), 'updated_at' => DB::raw('NOW()')]);
    }
}
