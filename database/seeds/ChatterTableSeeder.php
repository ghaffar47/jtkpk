<?php

use Illuminate\Database\Seeder;

class ChatterTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        // CREATE THE CATEGORIES
        DB::table('chatter_categories')->delete();
        DB::table('chatter_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'order' => 1,
                'name' => 'Umum',
                'color' => '#3498DB',
                'slug' => 'umum',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => NULL,
                'order' => 2,
                'name' => 'Perisian',
                'color' => '#2ECC71',
                'slug' => 'perisian',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => NULL,
                'order' => 3,
                'name' => 'Hardware',
                'color' => '#9B59B6',
                'slug' => 'hardware',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => NULL,
                'order' => 4,
                'name' => 'Utiliti',
                'color' => '#E67E22',
                'slug' => 'Utiliti',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => NULL,
                'order' => 5,
                'name' => 'Tugas Rasmi',
                'color' => '#FF6600',
                'slug' => 'tugas-rasmi',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => NULL,
                'order' => 6,
                'name' => 'Lain-Lain',
                'color' => '#FFCC00',
                'slug' => 'lain-lain',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));



        // CREATE THE DISCUSSIONS
        DB::table('chatter_discussion')->delete();
        DB::table('chatter_discussion')->insert(array (
            0 => 
            array (
                'id' => 1,
                'chatter_category_id' => 1,
                'title' => 'Selamat Datang ke FORUM Juruteknik !',
                'user_id' => 1,
                'sticky' => 0,
                'views' => 0,
                'answered' => 0,
                'created_at' => '2016-10-01 14:27:56',
                'updated_at' => '2016-10-01 14:27:56',
                'slug' => 'selamat-datang-ke-forum-juruteknik',
                'color' => '#239900',
            ),
        ));

        // CREATE THE POSTS
        DB::table('chatter_post')->delete();
        DB::table('chatter_post')->insert(array (
            0 => 
            array (
                'id' => 1,
                'chatter_discussion_id' => 1,
                'user_id' => 1,
                'body' => '<p>Assalamualaikum &amp; Salam Perak Excellent !</p><p>Disini kita boleh berbincang dan berdiskusi sesama kita berkaitan ICT, Tugasan Rasmi, aktiviti dan sebagainya.</p>',
                'created_at' => '2016-10-01 14:27:56',
                'updated_at' => '2016-10-01 14:27:56',
            ),
        ));
    }
}
