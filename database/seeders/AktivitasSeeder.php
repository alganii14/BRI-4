<?php

namespace Database\Seeders;

use App\Models\Aktivitas;
use App\Models\RMFT;
use App\Models\RencanaAktivitas;
use App\Models\AumDpk;
use App\Models\Layering;
use App\Models\MerchantSavol;
use App\Models\NonDebiturVolBesar;
use App\Models\OptimalisasiBusinessCluster;
use App\Models\PenurunanMerchant;
use App\Models\PenurunanPrioritasRitelMikro;
use App\Models\PerusahaanAnak;
use App\Models\QlolaNonDebitur;
use App\Models\QlolaNonaktif;
use App\Models\UserAktifCasaKecil;
use App\Models\PenurunanCasaBrilink;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AktivitasSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua RMFT
        $rmfts = RMFT::all();
        
        if ($rmfts->isEmpty()) {
            $this->command->error('Tidak ada RMFT di database. Jalankan RMFT seeder terlebih dahulu.');
            return;
        }

        // Ambil Rencana Aktivitas
        $rencanaAktivitas = RencanaAktivitas::where('is_active', true)->get();
        
        if ($rencanaAktivitas->isEmpty()) {
            $this->command->error('Tidak ada Rencana Aktivitas. Jalankan RencanaAktivitas seeder terlebih dahulu.');
            return;
        }

        // Mapping strategi ke model
        $strategiMapping = [
            'Strategi 1' => [
                'model' => AumDpk::class,
                'kategori' => 'AUM DPK',
                'segmen' => ['Prioritas', 'Komersial'],
            ],
            'Strategi 2' => [
                'model' => MerchantSavol::class,
                'kategori' => 'Merchant SAVOL',
                'segmen' => ['Merchant'],
            ],
            'Strategi 3' => [
                'model' => NonDebiturVolBesar::class,
                'kategori' => 'Non Debitur Volume Besar',
                'segmen' => ['Prioritas', 'Komersial', 'Ritel'],
            ],
            'Strategi 4' => [
                'model' => OptimalisasiBusinessCluster::class,
                'kategori' => 'Optimalisasi Business Cluster',
                'segmen' => ['Komersial', 'SME'],
            ],
            'Strategi 6' => [
                'model' => PenurunanMerchant::class,
                'kategori' => 'Penurunan Merchant',
                'segmen' => ['Merchant'],
            ],
            'Strategi 7' => [
                'model' => QlolaNonDebitur::class,
                'kategori' => 'Qlola Non Debitur',
                'segmen' => ['Ritel', 'Mikro', 'Komersial'],
            ],
            'Strategi 8' => [
                'model' => UserAktifCasaKecil::class,
                'kategori' => 'User Aktif CASA Kecil',
                'segmen' => ['Ritel', 'Mikro'],
            ],
            'Layering' => [
                'model' => Layering::class,
                'kategori' => 'Layering',
                'segmen' => ['Prioritas', 'Komersial', 'Ritel'],
            ],
        ];

        $statusRealisasi = ['tercapai', 'tidak_tercapai', 'lebih'];
        $tanggalRange = 30; // 30 hari ke belakang

        foreach ($rmfts as $rmft) {
            $this->command->info("Membuat aktivitas untuk RMFT: {$rmft->completename}");
            
            // Generate 1 tanggal random dalam 30 hari terakhir untuk semua 20 aktivitas RMFT ini
            $tanggal = Carbon::now()->subDays(rand(0, $tanggalRange));
            
            // Buat 20 aktivitas untuk setiap RMFT dengan tanggal yang sama
            for ($i = 1; $i <= 20; $i++) {
                // Pilih strategi random
                $strategiKeys = array_keys($strategiMapping);
                $strategyPipeline = $strategiKeys[array_rand($strategiKeys)];
                $strategiConfig = $strategiMapping[$strategyPipeline];
                
                // Ambil data dari tabel strategi
                $pipelineData = $strategiConfig['model']::inRandomOrder()->first();
                
                if (!$pipelineData) {
                    $this->command->warn("Tidak ada data untuk strategi: {$strategyPipeline}");
                    continue;
                }
                
                // Ambil rencana aktivitas random
                $rencana = $rencanaAktivitas->random();
                
                // Status realisasi random dengan distribusi:
                // 50% tercapai, 30% tidak_tercapai, 20% lebih dari target
                $rand = rand(1, 100);
                if ($rand <= 50) {
                    $status = 'tercapai';
                } elseif ($rand <= 80) {
                    $status = 'tidak_tercapai';
                } else {
                    $status = 'lebih';
                }
                
                // Generate nominal berdasarkan strategi
                $rpJumlah = $this->generateNominal($pipelineData, $strategiConfig['kategori']);
                
                // Generate nominal realisasi berdasarkan status
                $nominalRealisasi = $this->generateRealisasi($rpJumlah, $status);
                
                // Tanggal feedback 1-7 hari setelah tanggal aktivitas (jika ada realisasi)
                $tanggalFeedback = ($status !== 'tidak_tercapai') ? 
                    $tanggal->copy()->addDays(rand(1, 7)) : null;
                
                // Ambil data nasabah dari pipeline
                $nasabahData = $this->getNasabahData($pipelineData, $strategiConfig['kategori']);
                
                // Segmen random dari yang sesuai strategi
                $segmenNasabah = $strategiConfig['segmen'][array_rand($strategiConfig['segmen'])];
                
                Aktivitas::create([
                    'rmft_id' => $rmft->id,
                    'assigned_by' => 1, // Admin user
                    'tipe' => 'assigned', // Assigned dari pull of pipeline
                    'nasabah_id' => null,
                    'tanggal' => $tanggal,
                    'nama_rmft' => $rmft->completename,
                    'pn' => $rmft->pernr,
                    'kode_kc' => $nasabahData['kode_kc'] ?? null,
                    'nama_kc' => $nasabahData['nama_kc'] ?? null,
                    'kode_uker' => $nasabahData['kode_uker'] ?? null,
                    'nama_uker' => $nasabahData['nama_uker'] ?? null,
                    'kelompok' => $rmft->kelompok_jabatan ?? 'RMFT',
                    'strategy_pipeline' => $strategyPipeline,
                    'kategori_strategi' => $strategiConfig['kategori'],
                    'rencana_aktivitas' => $rencana->nama_rencana,
                    'rencana_aktivitas_id' => $rencana->id,
                    'segmen_nasabah' => $segmenNasabah,
                    'nama_nasabah' => $nasabahData['nama_nasabah'],
                    'norek' => $nasabahData['norek'],
                    'rp_jumlah' => $rpJumlah,
                    'keterangan' => $this->generateKeterangan($strategyPipeline, $rencana->nama_rencana),
                    'status_realisasi' => $status,
                    'nominal_realisasi' => $nominalRealisasi,
                    'keterangan_realisasi' => $this->generateKeteranganRealisasi($status, $nominalRealisasi, $rpJumlah),
                    'tanggal_feedback' => $tanggalFeedback,
                    'latitude' => $this->generateLatitude(),
                    'longitude' => $this->generateLongitude(),
                ]);
            }
        }
        
        $totalAktivitas = $rmfts->count() * 20;
        $this->command->info("Berhasil membuat {$totalAktivitas} aktivitas untuk " . $rmfts->count() . " RMFT");
    }

    /**
     * Generate nominal berdasarkan data pipeline
     */
    private function generateNominal($pipelineData, $kategori)
    {
        switch ($kategori) {
            case 'AUM DPK':
                $value = $pipelineData->aum ?? rand(50000000, 500000000);
                return $this->toNumeric($value);
            
            case 'Merchant SAVOL':
                $value = $pipelineData->casa_akhir_bulan ?? rand(10000000, 100000000);
                return $this->toNumeric($value);
            
            case 'Non Debitur Volume Besar':
                $value = $pipelineData->saldo ?? rand(50000000, 200000000);
                return $this->toNumeric($value);
            
            case 'Layering':
            case 'Penurunan Merchant':
                $delta = $pipelineData->delta ?? rand(5000000, 50000000);
                return abs($this->toNumeric($delta));
            
            case 'User Aktif CASA Kecil':
                $deltaSaldo = $pipelineData->delta_saldo ?? rand(1000000, 30000000);
                return abs($this->toNumeric($deltaSaldo));
            
            default:
                return rand(10000000, 100000000);
        }
    }

    /**
     * Convert string to numeric value
     */
    private function toNumeric($value)
    {
        if (is_numeric($value)) {
            return (float) $value;
        }
        
        if (is_string($value)) {
            // Remove dots (thousand separator) and replace comma with dot (decimal separator)
            $cleaned = str_replace(['.', ','], ['', '.'], $value);
            return (float) $cleaned;
        }
        
        return (float) $value;
    }

    /**
     * Generate nominal realisasi berdasarkan status
     */
    private function generateRealisasi($rpJumlah, $status)
    {
        if ($status === 'tidak_tercapai') {
            return 0;
        } elseif ($status === 'tercapai') {
            // 80-100% dari target
            return round($rpJumlah * (rand(80, 100) / 100));
        } else { // lebih dari target
            // 105-150% dari target
            return round($rpJumlah * (rand(105, 150) / 100));
        }
    }

    /**
     * Ambil data nasabah dari pipeline
     */
    private function getNasabahData($pipelineData, $kategori)
    {
        $data = [];
        
        // Extract nama nasabah
        if (isset($pipelineData->nama_nasabah)) {
            $data['nama_nasabah'] = $pipelineData->nama_nasabah;
        } elseif (isset($pipelineData->nama_merchant)) {
            $data['nama_nasabah'] = $pipelineData->nama_merchant;
        } elseif (isset($pipelineData->nama_debitur)) {
            $data['nama_nasabah'] = $pipelineData->nama_debitur;
        } elseif (isset($pipelineData->perusahaan)) {
            $data['nama_nasabah'] = $pipelineData->perusahaan;
        } else {
            $data['nama_nasabah'] = 'Nasabah ' . rand(1000, 9999);
        }
        
        // Extract nomor rekening
        if (isset($pipelineData->nomor_rekening)) {
            $data['norek'] = $pipelineData->nomor_rekening;
        } elseif (isset($pipelineData->no_rekening)) {
            $data['norek'] = $pipelineData->no_rekening;
        } elseif (isset($pipelineData->norekening)) {
            $data['norek'] = $pipelineData->norekening;
        } elseif (isset($pipelineData->norek_pinjaman)) {
            $data['norek'] = $pipelineData->norek_pinjaman;
        } else {
            $data['norek'] = '100' . str_pad(rand(1, 999999), 10, '0', STR_PAD_LEFT);
        }
        
        // Extract kode kantor cabang
        if (isset($pipelineData->kode_cabang_induk)) {
            $data['kode_kc'] = $pipelineData->kode_cabang_induk;
            $data['nama_kc'] = $pipelineData->cabang_induk ?? 'Cabang ' . $pipelineData->kode_cabang_induk;
        } elseif (isset($pipelineData->kode_kanca)) {
            $data['kode_kc'] = $pipelineData->kode_kanca;
            $data['nama_kc'] = $pipelineData->kanca ?? 'Kanca ' . $pipelineData->kode_kanca;
        } else {
            $data['kode_kc'] = sprintf('%03d', rand(1, 100));
            $data['nama_kc'] = 'Cabang ' . $data['kode_kc'];
        }
        
        // Extract kode uker
        if (isset($pipelineData->kode_uker)) {
            $data['kode_uker'] = $pipelineData->kode_uker;
            $data['nama_uker'] = $pipelineData->unit_kerja ?? $pipelineData->uker ?? 'Uker ' . $pipelineData->kode_uker;
        } else {
            $data['kode_uker'] = sprintf('%05d', rand(10000, 99999));
            $data['nama_uker'] = 'KCP ' . rand(1, 100);
        }
        
        return $data;
    }

    /**
     * Generate keterangan aktivitas
     */
    private function generateKeterangan($strategi, $rencana)
    {
        $keteranganTemplates = [
            'Strategi 1' => 'Follow up AUM DPK dengan ' . $rencana,
            'Strategi 2' => 'Monitoring SAVOL merchant dengan ' . $rencana,
            'Strategi 3' => 'Approach non debitur volume besar untuk ' . $rencana,
            'Strategi 4' => 'Optimalisasi business cluster melalui ' . $rencana,
            'Strategi 6' => 'Recovery penurunan merchant dengan ' . $rencana,
            'Strategi 7' => 'Aktivasi Qlola non debitur dengan ' . $rencana,
            'Strategi 8' => 'Maintenance user aktif CASA dengan ' . $rencana,
            'Layering' => 'Pencegahan layering dana dengan ' . $rencana,
        ];
        
        return $keteranganTemplates[$strategi] ?? 'Aktivitas ' . $rencana;
    }

    /**
     * Generate keterangan realisasi
     */
    private function generateKeteranganRealisasi($status, $nominalRealisasi, $rpJumlah)
    {
        if ($status === 'tidak_tercapai') {
            $alasan = [
                'Nasabah tidak dapat dihubungi',
                'Nasabah menunda keputusan',
                'Nasabah sudah pindah',
                'Nasabah menggunakan bank lain',
                'Belum ada kebutuhan saat ini',
            ];
            return $alasan[array_rand($alasan)];
        } elseif ($status === 'tercapai') {
            if ($rpJumlah > 0) {
                $persentase = round(($nominalRealisasi / $rpJumlah) * 100);
                return "Berhasil terealisasi {$persentase}% dari target";
            }
            return "Berhasil terealisasi";
        } else {
            if ($rpJumlah > 0) {
                $persentase = round(($nominalRealisasi / $rpJumlah) * 100);
                $selisih = $nominalRealisasi - $rpJumlah;
                return "Melebihi target {$persentase}%, surplus Rp " . number_format($selisih, 0, ',', '.');
            }
            return "Melebihi target";
        }
    }

    /**
     * Generate latitude (Jakarta area)
     */
    private function generateLatitude()
    {
        return -6.2 + (rand(0, 100000) / 1000000); // Around Jakarta
    }

    /**
     * Generate longitude (Jakarta area)
     */
    private function generateLongitude()
    {
        return 106.8 + (rand(0, 100000) / 1000000); // Around Jakarta
    }
}
