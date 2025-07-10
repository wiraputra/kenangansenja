<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\User; // Tidak perlu import UserSeeder di sini

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil UserSeeder
        $this->call(UserSeeder::class);
    }
}
