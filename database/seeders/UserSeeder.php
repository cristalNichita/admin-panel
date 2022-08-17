<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Admin',
                'last_name' => 'Adminovici',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456'),
                'role_id' => 1
            ],
            [
                'first_name' => 'Developer',
                'last_name' => 'Dev',
                'email' => 'dev@admin.com',
                'password' => Hash::make('123456'),
                'role_id' => 2
            ],
            [
                'first_name' => 'Manager',
                'last_name' => 'm',
                'email' => 'manager@admin.com',
                'password' => Hash::make('123456'),
                'role_id' => 3
            ],
            [
                'first_name' => 'Booker',
                'last_name' => 'Booker',
                'email' => 'booker@admin.com',
                'password' => Hash::make('123456'),
                'role_id' => 4
            ],
        ]);
    }
}
