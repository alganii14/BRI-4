<?php

namespace Database\Seeders;

use App\Models\QlolaNonaktif;
use Illuminate\Database\Seeder;

class QlolaNonaktifSeeder extends Seeder
{
    public function run()
    {
        $kodeKanca = ['001', '002', '003', '004', '005'];
        $kanca = ['Kanca Jakarta', 'Kanca Bandung', 'Kanca Surabaya', 'Kanca Medan', 'Kanca Semarang'];
        $uker = ['KCP Sudirman', 'KCP Dago', 'KCP Tunjungan', 'KCP Gatot Subroto', 'KCP Pandanaran'];
        $keterangan = ['Belum Ada Qlola', 'Qlola Nonaktif', 'Perlu Aktivasi'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            
            QlolaNonaktif::create([
                'kode_kanca' => $kodeKanca[$idx],
                'kanca' => $kanca[$idx],
                'kode_uker' => sprintf('%03d%02d', $idx + 1, rand(1, 99)),
                'uker' => $uker[$idx],
                'cifno' => 'CIF' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'norek_pinjaman' => '900' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'norek_simpanan' => '901' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'nama_debitur' => 'Debitur ' . $i,
                'plafon' => rand(50000000, 2000000000),
                'pn_pengelola' => 'PN' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'keterangan' => $keterangan[array_rand($keterangan)],
            ]);
        }
    }
}
