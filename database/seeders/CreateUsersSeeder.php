<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert( [[
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'is_admin'=>'1',
            'photo'=>'default.png',
            'password'=> bcrypt('123456'),
        ],[
            'name'=>'Member',
            'email'=>'member@member.com',
            'is_admin'=>'1',
            'photo'=>'default.png',
            'password'=> bcrypt('123456'),
         ]]);
    }
}
