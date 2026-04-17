<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Kenangan',
                'email' => 'admin@kenangansenja.com',
                'role' => 'admin',
                'address' => 'Kantor Pusat Kenangan Senja',
                'No_Telp' => '0811111111',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Barista Kenangan',
                'email' => 'barista@kenangansenja.com',
                'role' => 'barista',
                'address' => 'Outlet Kenangan Senja',
                'No_Telp' => '0822222222',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pembeli Kenangan',
                'email' => 'pembeli@kenangansenja.com',
                'role' => 'pembeli',
                'address' => 'Rumah Pelanggan Setia',
                'No_Telp' => '0833333333',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
