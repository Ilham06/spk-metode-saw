<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('passwordnyaadmin'),
                'role' => 'admin'
            ],
            [
                'name' => 'Ilham Muhamad S',
                'email' => 'ilham@mail.com',
                'password' => Hash::make('passwordnyailham'),
                'role' => 'admin'
            ],
            [
                'name' => 'Nadia Hinata',
                'email' => 'nadia@mail.com',
                'password' => Hash::make('passwordnyanadia'),
                'role' => 'user'
            ],
            [
                'name' => 'Andi Setiawan',
                'email' => 'andi@mail.com',
                'password' => Hash::make('passwordnyaandi'),
                'role' => 'user'
            ],
            [
                'name' => 'Marko Sandy',
                'email' => 'marko@mail.com',
                'password' => Hash::make('passwordnymarko'),
                'role' => 'user'
            ]
        ];

        User::insert($user);
    }
}
