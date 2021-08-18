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
        DB::table('users')->insert([
            //Admin
            [
                'name' => 'Kevin Admin',
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'admin',
                'status' => 'active',


            ],

            //Vendor

            [
                'name' => 'Kevin Vendor',
                'username' => 'Vendor',
                'email' => 'Vendor@gmail.com',
                'password' => Hash::make('1111'),
                'role' => 'vendor',
                'status' => 'active',


            ],

           //customer

            [
                'name' => 'Kevin Customer',
                'username' => 'Customer',
                'email' => 'Customer@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'customer',
                'status' => 'active',


            ],



        ]);
    }
}
