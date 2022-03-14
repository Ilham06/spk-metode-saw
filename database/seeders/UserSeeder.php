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
                'name' => 'Ilham Muhamad S',
                'email' => 'ilham@mail.com',
                'password' => Hash::make('passwordnyaadmin'),
                'role' => 'admin'
            ],
            [
                'name' => 'Nadia Hinata',
                'email' => 'nadia@mail.com',
                'password' => Hash::make('passwordnyauser'),
                'role' => 'user'
            ]
        ];

        User::insert($user);
    }
}
