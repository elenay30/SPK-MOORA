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
     */
    public function run(): void
    {
        // Cek apakah data admin sudah ada
        $adminExists = DB::table('users')->where('email', 'adminmoora2@moora.com')->exists();

        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'adminmoora2@yelena.com',
                'password' => Hash::make('@Yelenaadmin30'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Cek apakah data user sudah ada
        $userExists = DB::table('users')->where('email', 'kelompok2@moora.com')->exists();

        if (!$userExists) {
            DB::table('users')->insert([
                'name' => 'User',
                'email' => 'kelompok2@yelena.com',
                'password' => Hash::make('@Yelenamoorauser30'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
