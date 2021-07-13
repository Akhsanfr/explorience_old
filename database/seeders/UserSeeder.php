<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'Fernanda Akhsanuddin',
            'google_id' => '116245708681271289429',
            'avatar' => 'https://lh3.googleusercontent.com/a-/AOh14GgMA4LyPjGaigd6vah1AooX-072ZN61BqO6qwpi=s96-c',
            'email' => 'akhsan.fr@gmail.com',
            'is_active' => 1,
        ]);
        DB::table('users')->insert([
            'nama' => 'Fernanda Akhsanuddin Almas',
            'google_id' => '107957979697630434393',
            'avatar' => 'https://lh3.googleusercontent.com/a/AATXAJy56FiwaQ2em4X04eD-dB_o69oAm4Q2sYosDCOQ=s96-c',
            'email' => '4302180033_fernanda@pknstan.ac.id',
            'is_active' => 1,
        ]);
    }
}
