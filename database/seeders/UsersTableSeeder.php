<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('user')->insert([
        //     'userName' => 'Sherwin Yang',
        //     'email' => 'sher.yang79@gmail.com',
        //     'password' => Hash::make('asdfg12345'),
        // ]);

        // DB::table('user')->insert([
        //     'userName' => 'Andrew',
        //     'email' => 'andrew@gmail.com',
        //     'password' => Hash::make('qwerty123'),
        // ]);

        DB::table('user')->insert([
            'userName' => 'Evan',
            'email' => 'evan@gmail.com',
            'password' => Hash::make('evan1010'),
        ]);
    }
}
