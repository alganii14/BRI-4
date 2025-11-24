<?php

namespace Database\Seeders;

use App\Models\QlolaNonDebitur;
use Illuminate\Database\Seeder;

class QlolaNonDebiturSeeder extends Seeder
{
    public function run()
    {
        $kodeKanca = ['001', '002', '003', '004', '005'];
        $kanca = ['Kanca Jakarta', 'Kanca Bandung', 'Kanca Surabaya', 'Kanca Medan', 'Kanca Semarang'];
        $uker = ['KCP Sudirman', 'KCP Dago', 'KCP Tunjungan', 'KCP Gatot Subroto', 'KCP Pandanaran'];
        $segmentasi = ['Prioritas', 'Komersial', 'Ritel', 'Mikro'];
        $keterangan = ['Belum Ada Qlola', 'Qlola Nonaktif', 'Perlu Follow Up'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            
            QlolaNonDebitur::create([
                'kode_kanca' => $kodeKanca[$idx],
                'kanca' => $kanca[$idx],
                'kode_uker' => sprintf('%03d%02d', $idx + 1, rand(1, 99)),
                'uker' => $uker[$idx],
                'cifno' => 'CIF' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'no_rekening' => '800' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'nama_nasabah' => 'Nasabah ' . $i,
                'segmentasi' => $segmentasi[array_rand($segmentasi)],
                'cek_qcash' => ['Ya', 'Tidak'][array_rand(['Ya', 'Tidak'])],
                'cek_cms' => ['Ya', 'Tidak'][array_rand(['Ya', 'Tidak'])],
                'cek_ib' => ['Ya', 'Tidak'][array_rand(['Ya', 'Tidak'])],
                'keterangan' => $keterangan[array_rand($keterangan)],
            ]);
        }
    }
}
