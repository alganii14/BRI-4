<?php

namespace Database\Seeders;

use App\Models\PenurunanCasaBrilink;
use Illuminate\Database\Seeder;

class PenurunanCasaBrilinkSeeder extends Seeder
{
    public function run()
    {
        $kodeCabangInduk = ['001', '002', '003', '004', '005'];
        $cabangInduk = ['Cabang Jakarta', 'Cabang Bandung', 'Cabang Surabaya', 'Cabang Medan', 'Cabang Semarang'];
        $unitKerja = ['KCP Sudirman', 'KCP Dago', 'KCP Tunjungan', 'KCP Gatot Subroto', 'KCP Pandanaran'];
        $jenisSimpanan = ['Tabungan', 'Giro'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            $saldoLastEom = rand(5000000, 100000000);
            $saldoTerupdate = $saldoLastEom - rand(1000000, 30000000);
            
            PenurunanCasaBrilink::create([
                'kode_cabang_induk' => $kodeCabangInduk[$idx],
                'cabang_induk' => $cabangInduk[$idx],
                'kode_uker' => sprintf('%03d%02d', $idx + 1, rand(1, 99)),
                'unit_kerja' => $unitKerja[$idx],
                'cifno' => 'CIF' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'no_rekening' => '980' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'nama_nasabah' => 'Nasabah Brilink ' . $i,
                'jenis_simpanan' => $jenisSimpanan[array_rand($jenisSimpanan)],
                'saldo_last_eom' => $saldoLastEom,
                'saldo_terupdate' => $saldoTerupdate,
                'delta' => $saldoTerupdate - $saldoLastEom,
            ]);
        }
    }
}
