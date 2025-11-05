<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
           [
                'username'        => 'user1',
                'email'           => 'user1@gmail.com',
                'password'        => Hash::make('senha123'),
                'remember_token'  => Str::random(10),   
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'username'        => 'user41',
                'email'           => 'user41@gmail.com',
                'password'        => Hash::make('senha123'),
                'remember_token'  => Str::random(10),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'username'        => 'user31',
                'email'           => 'user31@gmail.com',
                'password'        => Hash::make('senha123'),
                'remember_token'  => Str::random(10),
                'created_at'      => now(),
                'updated_at'      => now(),
            ],

        ]);
    }
}

