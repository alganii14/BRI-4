<?php

namespace Database\Seeders;

use App\Models\AumDpk;
use Illuminate\Database\Seeder;

class AumDpkSeeder extends Seeder
{
    public function run()
    {
        $kodeCabangInduk = ['001', '002', '003', '004', '005'];
        $cabangInduk = ['Cabang Jakarta', 'Cabang Bandung', 'Cabang Surabaya', 'Cabang Medan', 'Cabang Semarang'];
        $unitKerja = ['KCP Sudirman', 'KCP Dago', 'KCP Tunjungan', 'KCP Gatot Subroto', 'KCP Pandanaran'];
        $segmentasi = ['Prioritas', 'Komersial', 'Ritel', 'Mikro'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            AumDpk::create([
                'kode_cabang_induk' => $kodeCabangInduk[$idx],
                'cabang_induk' => $cabangInduk[$idx],
                'kode_uker' => sprintf('%03d%02d', $idx + 1, rand(1, 99)),
                'unit_kerja' => $unitKerja[$idx],
                'slp' => 'SLP' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'pbo' => 'PBO' . rand(1000, 9999),
                'cif' => 'CIF' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'id_prioritas' => $segmentasi[array_rand($segmentasi)],
                'nama_nasabah' => 'Nasabah ' . $i,
                'nomor_rekening' => '100' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'aum' => rand(50000000, 5000000000),
            ]);
        }
    }
}
