<?php

namespace Database\Seeders;

use App\Models\UserAktifCasaKecil;
use Illuminate\Database\Seeder;

class UserAktifCasaKecilSeeder extends Seeder
{
    public function run()
    {
        $kodeKanca = ['001', '002', '003', '004', '005'];
        $kanca = ['Kanca Jakarta', 'Kanca Bandung', 'Kanca Surabaya', 'Kanca Medan', 'Kanca Semarang'];
        $uker = ['KCP Sudirman', 'KCP Dago', 'KCP Tunjungan', 'KCP Gatot Subroto', 'KCP Pandanaran'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            $saldoBulanLalu = rand(1000000, 50000000);
            $saldoBulanBerjalan = rand(500000, 45000000);
            
            UserAktifCasaKecil::create([
                'kode_kanca' => $kodeKanca[$idx],
                'kanca' => $kanca[$idx],
                'kode_uker' => sprintf('%03d%02d', $idx + 1, rand(1, 99)),
                'uker' => $uker[$idx],
                'nama_nasabah' => 'Nasabah ' . $i,
                'cifno' => 'CIF' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'norek_pinjaman' => '950' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'saldo_bulan_lalu' => $saldoBulanLalu,
                'saldo_bulan_berjalan' => $saldoBulanBerjalan,
                'delta_saldo' => $saldoBulanBerjalan - $saldoBulanLalu,
                'nama_rm_pemrakarsa' => 'RM ' . $i,
                'qcash' => ['Ya', 'Tidak'][array_rand(['Ya', 'Tidak'])],
                'qib' => ['Ya', 'Tidak'][array_rand(['Ya', 'Tidak'])],
            ]);
        }
    }
}
