<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'username' => 'user1@gmail.com',
            'password' => bcrypt('abc123'),
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'username' => 'user41@gmail.com',
            'password' => bcrypt('abc123'),
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
            'username' => 'use31@gmail.com',
            'password' => bcrypt('abc123'),
            'created_at' => date('Y-m-d H:i:s')
            ]

        ]);
    }
}
