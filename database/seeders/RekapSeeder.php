<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rekap;

class RekapSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        Rekap::truncate();

        // Sample data sesuai dengan screenshot
        $data = [
            [
                'nama_kc' => 'KC Sumedang',
                'pn' => '254416',
                'nama_rmft' => 'ANDRI PURNAMA',
                'nama_pemilik' => 'Bryan udfil',
                'no_rekening' => '1234567890',
                'pipeline' => 150000000,
                'realisasi' => 120000000,
                'keterangan' => 'Realisasi sesuai target',
                'validasi' => 'Approved',
            ],
            [
                'nama_kc' => 'KC Kuningan',
                'pn' => '282247',
                'nama_rmft' => 'Adam Nugraha',
                'nama_pemilik' => 'Andi Prasetyo',
                'no_rekening' => '0987654321',
                'pipeline' => 200000000,
                'realisasi' => 180000000,
                'keterangan' => 'Cross selling produk tabungan',
                'validasi' => 'Approved',
            ],
            [
                'nama_kc' => 'KC Kuningan',
                'pn' => '282247',
                'nama_rmft' => 'Adam Nugraha',
                'nama_pemilik' => 'Budi Santoso',
                'no_rekening' => '1122334455',
                'pipeline' => 175000000,
                'realisasi' => 150000000,
                'keterangan' => 'Edukasi penggunaan EDC dan QRIS',
                'validasi' => 'Pending',
            ],
            [
                'nama_kc' => 'KC Kuningan',
                'pn' => '282247',
                'nama_rmft' => 'Adam Nugraha',
                'nama_pemilik' => 'CV Distributor Elektronik',
                'no_rekening' => '2233445566',
                'pipeline' => 280000000,
                'realisasi' => 280000000,
                'keterangan' => 'Cross selling produk kredit',
                'validasi' => 'Approved',
            ],
            [
                'nama_kc' => 'KC Kuningan',
                'pn' => '282247',
                'nama_rmft' => 'Adam Nugraha',
                'nama_pemilik' => 'CV Mebel Jati Indah',
                'no_rekening' => '3344556677',
                'pipeline' => 200000000,
                'realisasi' => 200000000,
                'keterangan' => 'Realisasi sesuai target',
                'validasi' => 'Approved',
            ],
        ];

        foreach ($data as $item) {
            Rekap::create($item);
        }
    }
}
