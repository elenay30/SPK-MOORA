<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kedisiplinan (C1)
        $this->createSubKriteriasForKriteria(1, [
            ['keterangan' => 'Sangat Baik', 'nilai' => 4],
            ['keterangan' => 'Baik', 'nilai' => 3],
            ['keterangan' => 'Cukup', 'nilai' => 2],
            ['keterangan' => 'Buruk', 'nilai' => 1],
        ]);

        // Kerjasama Tim (C2)
        $this->createSubKriteriasForKriteria(2, [
            ['keterangan' => 'Sangat Baik', 'nilai' => 4],
            ['keterangan' => 'Baik', 'nilai' => 3],
            ['keterangan' => 'Cukup', 'nilai' => 2],
            ['keterangan' => 'Buruk', 'nilai' => 1],
        ]);

        // Sikap (C3)
        $this->createSubKriteriasForKriteria(3, [
            ['keterangan' => 'Sangat Baik', 'nilai' => 4],
            ['keterangan' => 'Baik', 'nilai' => 3],
            ['keterangan' => 'Cukup', 'nilai' => 2],
            ['keterangan' => 'Buruk', 'nilai' => 1],
        ]);

        // Kehadiran (C4)
        $this->createSubKriteriasForKriteria(4, [
            ['keterangan' => 'Sangat Baik', 'nilai' => 4],
            ['keterangan' => 'Baik', 'nilai' => 3],
            ['keterangan' => 'Cukup', 'nilai' => 2],
            ['keterangan' => 'Buruk', 'nilai' => 1],
        ]);

        // Skill (C5)
        $this->createSubKriteriasForKriteria(5, [
            ['keterangan' => 'Sangat Baik', 'nilai' => 4],
            ['keterangan' => 'Baik', 'nilai' => 3],
            ['keterangan' => 'Cukup', 'nilai' => 2],
            ['keterangan' => 'Buruk', 'nilai' => 1],
        ]);

        // Loyalitas (C6)
        $this->createSubKriteriasForKriteria(6, [
            ['keterangan' => 'Sangat Baik', 'nilai' => 4],
            ['keterangan' => 'Baik', 'nilai' => 3],
            ['keterangan' => 'Cukup', 'nilai' => 2],
            ['keterangan' => 'Buruk', 'nilai' => 1],
        ]);

        // Masa Kerja (C7) - skip karena input manual, bukan dropdown
        // C7 akan di-input langsung sebagai tahun (misal: 1, 4, 18, 22, dst)

        // Produktifitas (C8)
        $this->createSubKriteriasForKriteria(8, [
            ['keterangan' => 'Sangat Bagus', 'nilai' => 4],
            ['keterangan' => 'Bagus', 'nilai' => 3],
            ['keterangan' => 'Cukup', 'nilai' => 2],
            ['keterangan' => 'Kurang', 'nilai' => 1],
        ]);
    }

    /**
     * Helper function to create sub kriterias for a kriteria
     */
    private function createSubKriteriasForKriteria($kriteria_id, $subKriterias)
    {
        foreach ($subKriterias as $subKriteria) {
            DB::table('sub_kriterias')->insert([
                'kriteria_id' => $kriteria_id,
                'keterangan' => $subKriteria['keterangan'],
                'nilai' => $subKriteria['nilai'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}