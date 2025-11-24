<?php

namespace Database\Seeders;

use App\Models\MerchantSavol;
use Illuminate\Database\Seeder;

class MerchantSavolSeeder extends Seeder
{
    public function run()
    {
        $kodeKanca = ['001', '002', '003', '004', '005'];
        $kanca = ['Kanca Jakarta', 'Kanca Bandung', 'Kanca Surabaya', 'Kanca Medan', 'Kanca Semarang'];
        $uker = ['KCP Sudirman', 'KCP Dago', 'KCP Tunjungan', 'KCP Gatot Subroto', 'KCP Pandanaran'];
        $jenisMerchant = ['Retail', 'F&B', 'Jasa', 'Pendidikan', 'Kesehatan'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            
            MerchantSavol::create([
                'kode_kanca' => $kodeKanca[$idx],
                'kanca' => $kanca[$idx],
                'kode_uker' => sprintf('%03d%02d', $idx + 1, rand(1, 99)),
                'uker' => $uker[$idx],
                'jenis_merchant' => $jenisMerchant[array_rand($jenisMerchant)],
                'tid_store_id' => 'TID' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'nama_merchant' => 'Merchant ' . $i,
                'alamat_merchant' => 'Jalan Merchant No. ' . $i,
                'norekening' => '300' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'cif' => 'CIF' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'savol_bulan_lalu' => rand(5000000, 100000000),
                'casa_akhir_bulan' => rand(3000000, 80000000),
            ]);
        }
    }
}
