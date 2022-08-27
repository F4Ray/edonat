<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'f4raymail@gmail.com',
            'password' => Hash::make('qwerty123'),
            'id_role' => 2,
            'id_profile' => 999,
            'email_verified_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'email' => 'admin@mail.com',
            'password' => Hash::make('qwerty123'),
            'id_role' => 1,
            'id_profile' => 1,
            'email_verified_at' => Carbon::now()
        ]);

        DB::table('donatur')->insert([
            'nama' => 'Admin'
        ]);
    }
}