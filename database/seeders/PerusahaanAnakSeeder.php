<?php

namespace Database\Seeders;

use App\Models\PerusahaanAnak;
use Illuminate\Database\Seeder;

class PerusahaanAnakSeeder extends Seeder
{
    public function run()
    {
        $kodeCabangInduk = ['001', '002', '003', '004', '005'];
        $cabangInduk = ['Cabang Jakarta', 'Cabang Bandung', 'Cabang Surabaya', 'Cabang Medan', 'Cabang Semarang'];
        $jenisUsaha = ['Teknologi', 'Manufaktur', 'Retail', 'Jasa', 'Logistik'];
        $perusahaanAnak = ['BRI Life', 'BRI Ventura', 'BRI Insurance', 'BRI Danareksa', 'BRI Finance'];
        $statusPipeline = ['Prospect', 'Follow Up', 'Closing', 'Rejected'];

        for ($i = 1; $i <= 500; $i++) {
            $idx = $i % 5;
            
            PerusahaanAnak::create([
                'nama_partner_vendor' => 'Partner Vendor ' . $i,
                'jenis_usaha' => $jenisUsaha[array_rand($jenisUsaha)],
                'alamat' => 'Jalan Partner No. ' . $i,
                'kode_cabang_induk' => $kodeCabangInduk[$idx],
                'cabang_induk_terdekat' => $cabangInduk[$idx],
                'nama_pic_partner' => 'PIC Partner ' . $i,
                'posisi_pic_partner' => ['Direktur', 'Manager', 'Supervisor'][array_rand(['Direktur', 'Manager', 'Supervisor'])],
                'hp_pic_partner' => '08' . rand(100000000, 999999999),
                'nama_perusahaan_anak' => $perusahaanAnak[array_rand($perusahaanAnak)],
                'status_pipeline' => $statusPipeline[array_rand($statusPipeline)],
            ]);
        }
    }
}
