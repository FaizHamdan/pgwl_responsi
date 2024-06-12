<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        //create multiple users
        $user = [
            [
                'name' => 'Admin',
                'phone' => '081111113233',
                'email' => 'aizhamdan@gmail.com',
                'password' => bcrypt('admin'),
            ],
            [
                'name' => 'Admin',
                'phone' => '08566473838',
                'email' => 'faizhamdan@gmail.com',
                'password' => bcrypt('admin'),
            ],
        ];

        //insert the user into the database
        DB::table('users')->insert($user);

    }
}