<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternatifs')->insert([
            [
                'kode' => 'A1',
                'nama' => 'Zaenal Abidin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A2',
                'nama' => 'Bahrun Najah',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A3',
                'nama' => 'Nana Sucianta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A4',
                'nama' => 'Ela Nurnaila',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A5',
                'nama' => 'Atiek kartika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A6',
                'nama' => 'Deni Sukaendar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A7',
                'nama' => 'Windi Arpans',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A8',
                'nama' => 'Muhtar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A9',
                'nama' => 'Charly Christopher',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A10',
                'nama' => 'Sofyan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}