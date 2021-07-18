<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'nama' => 'admin',
        ]);
        DB::table('roles')->insert([
            'nama' => 'supervisor',
        ]);
        DB::table('roles')->insert([
            'nama' => 'writer',
        ]);
        DB::table('roles')->insert([
            'nama' => 'podcaster',
        ]);
        DB::table('roles')->insert([
            'nama' => 'guest',
        ]);

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            KategoriSeeder::class,
            ArtikelSeeder::class,
            KomentarSeeder::class,
            KuisSeeder::class,
        ]);
    }
}
