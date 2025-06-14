<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data penilaian berdasarkan tabel yang diberikan
        $penilaians = [
            // Zaenal Abidin (A1)
            ['alternatif_id' => 1, 'kriteria_id' => 1, 'nilai' => 3], // C1
            ['alternatif_id' => 1, 'kriteria_id' => 2, 'nilai' => 3], // C2
            ['alternatif_id' => 1, 'kriteria_id' => 3, 'nilai' => 3], // C3
            ['alternatif_id' => 1, 'kriteria_id' => 4, 'nilai' => 3], // C4
            ['alternatif_id' => 1, 'kriteria_id' => 5, 'nilai' => 3], // C5
            ['alternatif_id' => 1, 'kriteria_id' => 6, 'nilai' => 3], // C6
            ['alternatif_id' => 1, 'kriteria_id' => 7, 'nilai' => 4], // C7
            ['alternatif_id' => 1, 'kriteria_id' => 8, 'nilai' => 3], // C8

            // Bahrun Najah (A2)
            ['alternatif_id' => 2, 'kriteria_id' => 1, 'nilai' => 4], // C1
            ['alternatif_id' => 2, 'kriteria_id' => 2, 'nilai' => 4], // C2
            ['alternatif_id' => 2, 'kriteria_id' => 3, 'nilai' => 4], // C3
            ['alternatif_id' => 2, 'kriteria_id' => 4, 'nilai' => 4], // C4
            ['alternatif_id' => 2, 'kriteria_id' => 5, 'nilai' => 4], // C5
            ['alternatif_id' => 2, 'kriteria_id' => 6, 'nilai' => 4], // C6
            ['alternatif_id' => 2, 'kriteria_id' => 7, 'nilai' => 22], // C7
            ['alternatif_id' => 2, 'kriteria_id' => 8, 'nilai' => 4], // C8

            // Nana Sucianta (A3)
            ['alternatif_id' => 3, 'kriteria_id' => 1, 'nilai' => 4], // C1
            ['alternatif_id' => 3, 'kriteria_id' => 2, 'nilai' => 4], // C2
            ['alternatif_id' => 3, 'kriteria_id' => 3, 'nilai' => 4], // C3
            ['alternatif_id' => 3, 'kriteria_id' => 4, 'nilai' => 4], // C4
            ['alternatif_id' => 3, 'kriteria_id' => 5, 'nilai' => 3], // C5
            ['alternatif_id' => 3, 'kriteria_id' => 6, 'nilai' => 4], // C6
            ['alternatif_id' => 3, 'kriteria_id' => 7, 'nilai' => 1], // C7
            ['alternatif_id' => 3, 'kriteria_id' => 8, 'nilai' => 4], // C8

            // Ela Nurnaila (A4)
            ['alternatif_id' => 4, 'kriteria_id' => 1, 'nilai' => 3], // C1
            ['alternatif_id' => 4, 'kriteria_id' => 2, 'nilai' => 3], // C2
            ['alternatif_id' => 4, 'kriteria_id' => 3, 'nilai' => 3], // C3
            ['alternatif_id' => 4, 'kriteria_id' => 4, 'nilai' => 3], // C4
            ['alternatif_id' => 4, 'kriteria_id' => 5, 'nilai' => 3], // C5
            ['alternatif_id' => 4, 'kriteria_id' => 6, 'nilai' => 3], // C6
            ['alternatif_id' => 4, 'kriteria_id' => 7, 'nilai' => 18], // C7
            ['alternatif_id' => 4, 'kriteria_id' => 8, 'nilai' => 3], // C8

            // Atiek kartika (A5)
            ['alternatif_id' => 5, 'kriteria_id' => 1, 'nilai' => 3], // C1
            ['alternatif_id' => 5, 'kriteria_id' => 2, 'nilai' => 4], // C2
            ['alternatif_id' => 5, 'kriteria_id' => 3, 'nilai' => 4], // C3
            ['alternatif_id' => 5, 'kriteria_id' => 4, 'nilai' => 3], // C4
            ['alternatif_id' => 5, 'kriteria_id' => 5, 'nilai' => 3], // C5
            ['alternatif_id' => 5, 'kriteria_id' => 6, 'nilai' => 4], // C6
            ['alternatif_id' => 5, 'kriteria_id' => 7, 'nilai' => 1], // C7
            ['alternatif_id' => 5, 'kriteria_id' => 8, 'nilai' => 3], // C8

            // Deni Sukaendar (A6)
            ['alternatif_id' => 6, 'kriteria_id' => 1, 'nilai' => 2], // C1
            ['alternatif_id' => 6, 'kriteria_id' => 2, 'nilai' => 3], // C2
            ['alternatif_id' => 6, 'kriteria_id' => 3, 'nilai' => 3], // C3
            ['alternatif_id' => 6, 'kriteria_id' => 4, 'nilai' => 4], // C4
            ['alternatif_id' => 6, 'kriteria_id' => 5, 'nilai' => 2], // C5
            ['alternatif_id' => 6, 'kriteria_id' => 6, 'nilai' => 3], // C6
            ['alternatif_id' => 6, 'kriteria_id' => 7, 'nilai' => 20], // C7
            ['alternatif_id' => 6, 'kriteria_id' => 8, 'nilai' => 2], // C8

            // Windi Arpans (A7)
            ['alternatif_id' => 7, 'kriteria_id' => 1, 'nilai' => 2], // C1
            ['alternatif_id' => 7, 'kriteria_id' => 2, 'nilai' => 3], // C2
            ['alternatif_id' => 7, 'kriteria_id' => 3, 'nilai' => 3], // C3
            ['alternatif_id' => 7, 'kriteria_id' => 4, 'nilai' => 4], // C4
            ['alternatif_id' => 7, 'kriteria_id' => 5, 'nilai' => 3], // C5
            ['alternatif_id' => 7, 'kriteria_id' => 6, 'nilai' => 3], // C6
            ['alternatif_id' => 7, 'kriteria_id' => 7, 'nilai' => 16], // C7
            ['alternatif_id' => 7, 'kriteria_id' => 8, 'nilai' => 4], // C8

            // Muhtar (A8)
            ['alternatif_id' => 8, 'kriteria_id' => 1, 'nilai' => 3], // C1
            ['alternatif_id' => 8, 'kriteria_id' => 2, 'nilai' => 3], // C2
            ['alternatif_id' => 8, 'kriteria_id' => 3, 'nilai' => 3], // C3
            ['alternatif_id' => 8, 'kriteria_id' => 4, 'nilai' => 4], // C4
            ['alternatif_id' => 8, 'kriteria_id' => 5, 'nilai' => 3], // C5
            ['alternatif_id' => 8, 'kriteria_id' => 6, 'nilai' => 2], // C6
            ['alternatif_id' => 8, 'kriteria_id' => 7, 'nilai' => 1], // C7
            ['alternatif_id' => 8, 'kriteria_id' => 8, 'nilai' => 2], // C8

            // Charly Christopher (A9)
            ['alternatif_id' => 9, 'kriteria_id' => 1, 'nilai' => 4], // C1
            ['alternatif_id' => 9, 'kriteria_id' => 2, 'nilai' => 4], // C2
            ['alternatif_id' => 9, 'kriteria_id' => 3, 'nilai' => 4], // C3
            ['alternatif_id' => 9, 'kriteria_id' => 4, 'nilai' => 4], // C4
            ['alternatif_id' => 9, 'kriteria_id' => 5, 'nilai' => 4], // C5
            ['alternatif_id' => 9, 'kriteria_id' => 6, 'nilai' => 4], // C6
            ['alternatif_id' => 9, 'kriteria_id' => 7, 'nilai' => 7], // C7
            ['alternatif_id' => 9, 'kriteria_id' => 8, 'nilai' => 4], // C8

            // Sofyan (A10)
            ['alternatif_id' => 10, 'kriteria_id' => 1, 'nilai' => 4], // C1
            ['alternatif_id' => 10, 'kriteria_id' => 2, 'nilai' => 3], // C2
            ['alternatif_id' => 10, 'kriteria_id' => 3, 'nilai' => 4], // C3
            ['alternatif_id' => 10, 'kriteria_id' => 4, 'nilai' => 4], // C4
            ['alternatif_id' => 10, 'kriteria_id' => 5, 'nilai' => 4], // C5
            ['alternatif_id' => 10, 'kriteria_id' => 6, 'nilai' => 4], // C6
            ['alternatif_id' => 10, 'kriteria_id' => 7, 'nilai' => 1], // C7
            ['alternatif_id' => 10, 'kriteria_id' => 8, 'nilai' => 4], // C8
        ];

        // Insert data penilaian
        foreach ($penilaians as $penilaian) {
            DB::table('penilaians')->insert([
                'alternatif_id' => $penilaian['alternatif_id'],
                'kriteria_id' => $penilaian['kriteria_id'],
                'nilai' => $penilaian['nilai'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}