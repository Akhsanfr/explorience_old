<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('komentars')->insert([
            'id_parent' => null,
            'id_tag' => null,
            'komen' => 'Ini Komentar A',
            'artikel_id' => 1,
            'user_id' => 1,
            'created_at' => '2021-07-04 09:21:43',
            'updated_at' => '2021-07-04 09:21:43',
        ]);
        DB::table('komentars')->insert([
            'id_parent' => null,
            'id_tag' => null,
            'komen' => 'Ini Komentar B',
            'artikel_id' => 1,
            'user_id' => 1,
            'created_at' => '2021-07-04 09:21:43',
            'updated_at' => '2021-07-04 09:21:43',
        ]);
        DB::table('komentars')->insert([
            'id_parent' => 1,
            'id_tag' => null,
            'komen' => 'Ini Reply Komentar A',
            'artikel_id' => 1,
            'user_id'=> 2,
            'created_at' => '2021-07-04 09:21:43',
            'updated_at' => '2021-07-04 09:21:43',
        ]);
        DB::table('komentars')->insert([
            'id_parent' => 2,
            'id_tag' => null,
            'komen' => 'Ini Reply Komentar B',
            'artikel_id' => 1,
            'user_id'=> 2,
            'created_at' => '2021-07-04 09:21:43',
            'updated_at' => '2021-07-04 09:21:43',
        ]);
    }
}
