<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriterias')->insert([
            [
                'kode' => 'C1',
                'nama' => 'Kedisiplinan',
                'bobot' => 0.26,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C2',
                'nama' => 'Kerjasama Tim',
                'bobot' => 0.19,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C3',
                'nama' => 'Sikap',
                'bobot' => 0.16,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C4',
                'nama' => 'Kehadiran',
                'bobot' => 0.12,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C5',
                'nama' => 'Skill',
                'bobot' => 0.11,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C6',
                'nama' => 'Loyalitas',
                'bobot' => 0.08,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C7',
                'nama' => 'Masa Kerja',
                'bobot' => 0.05,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C8',
                'nama' => 'Produktifitas',
                'bobot' => 0.03,
                'jenis' => 'benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}