<?php

namespace Database\Seeders;

use App\Models\OptimalisasiBusinessCluster;
use Illuminate\Database\Seeder;

class OptimalisasiBusinessClusterSeeder extends Seeder
{
    public function run()
    {
        $kodeCabangInduk = ['001', '002', '003', '004', '005'];
        $cabangInduk = ['Cabang Jakarta', 'Cabang Bandung', 'Cabang Surabaya', 'Cabang Medan', 'Cabang Semarang'];
        $unitKerja = ['KCP Sudirman', 'KCP Dago', 'KCP Tunjungan', 'KCP Gatot Subroto', 'KCP Pandanaran'];
        $tagZona = ['Zona A', 'Zona B', 'Zona C', 'Zona Unggulan'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            
            OptimalisasiBusinessCluster::create([
                'kode_cabang_induk' => $kodeCabangInduk[$idx],
                'cabang_induk' => $cabangInduk[$idx],
                'kode_uker' => sprintf('%03d%02d', $idx + 1, rand(1, 99)),
                'unit_kerja' => $unitKerja[$idx],
                'tag_zona_unggulan' => $tagZona[array_rand($tagZona)],
                'nomor_rekening' => '500' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'nama_usaha_pusat_bisnis' => 'Pusat Bisnis ' . $i,
                'nama_tenaga_pemasar' => 'Pemasar ' . $i,
            ]);
        }
    }
}
