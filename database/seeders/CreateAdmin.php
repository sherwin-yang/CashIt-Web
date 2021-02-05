<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('admin')->insert([
        //     'adminName' => 'Sherwin Yang',
        //     'email' => 'sher.yang79@gmail.com',
        //     'password' => Hash::make('sherwin7879'),
        // ]);
    }
}
