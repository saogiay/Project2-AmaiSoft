<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DbColor extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'name' => 'Red',
            'code' => '#ff0000'
        ]);

        DB::table('colors')->insert([
            'name' => 'White',
            'code' => '#ffffff'
        ]);

        DB::table('colors')->insert([
            'name' => 'Green',
            'code' => '#008000'
        ]);

        DB::table('colors')->insert([
            'name' => 'Blue',
            'code' => '#0000ff'
        ]);

        DB::table('colors')->insert([
            'name' => 'Violet',
            'code' => '#ee82ee'
        ]);

        DB::table('colors')->insert([
            'name' => 'Gray',
            'code' => '#808080'
        ]);
    }
}
