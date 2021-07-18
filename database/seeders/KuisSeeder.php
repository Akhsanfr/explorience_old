<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KuisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kuis')->insert([
            'pertanyaan' => 'Apa nama buah yang segar ?',
            'a' => 'melon',
            'b' => 'semangka',
            'c' => 'jeruk',
            'd' => 'anggur',
            'jawaban' => 'b',
            'artikel_id' => 1,
        ]);
        DB::table('kuis')->insert([
            'pertanyaan' => 'Apa nama buah berwarna hijau ?',
            'a' => 'melon',
            'b' => 'semangka',
            'c' => 'jeruk',
            'd' => 'anggur',
            'jawaban' => 'a',
            'artikel_id' => 1,
        ]);
        DB::table('kuis')->insert([
            'pertanyaan' => 'Apa nama yang paling kecil ukurannya ?',
            'a' => 'melon',
            'b' => 'semangka',
            'c' => 'jeruk',
            'd' => 'anggur',
            'jawaban' => 'd',
            'artikel_id' => 1,
        ]);
    }
}
