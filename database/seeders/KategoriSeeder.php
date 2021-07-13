<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            'nama' => 'Ekonomi',
            'nama_en' => 'Economy',
        ]);
        DB::table('kategoris')->insert([
            'nama' => 'Bahasa Inggris',
            'nama_en' => 'English',
        ]);
    }
}
