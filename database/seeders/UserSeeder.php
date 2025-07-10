<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create(
        [
          'name' => 'ley',
            'role' => 'admin',
            'email' => 'lin@gmail.com',
            'password' => Hash::make('123'),  // Menggunakan bcrypt untuk hash password
            'address' => 'batukapur',
            'No_Telp' => '0703647398'  
        ]
    );
    }
}
