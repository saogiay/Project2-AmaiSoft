<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DbAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'phone' => '0123456789',
            'password' => bcrypt('123'),
            'role' => '1',
            'status' => '1',
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);
    }   
}
