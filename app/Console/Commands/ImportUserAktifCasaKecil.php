<?php

namespace App\Console\Commands;

use App\Models\UserAktifCasaKecil;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportUserAktifCasaKecil extends Command
{
    protected $signature = 'import:user-aktif-casa-kecil {file}';
    protected $description = 'Import User Aktif Casa Kecil data from CSV file';

    public function handle()
    {
        $filePath = $this->argument('file');
        
        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        $this->info('Memulai import data User Aktif Casa Kecil...');
        
        DB::beginTransaction();
        try {
            $handle = fopen($filePath, 'r');
            $header = fgetcsv($handle, 0, ';');
            
            $batchData = [];
            $batchSize = 1000;
            $totalRows = 0;
            
            $this->output->progressStart();
            
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (count($row) < 13) continue;
                
                // Skip rows with no meaningful data
                if (empty(array_filter($row))) continue;
                
                $batchData[] = [
                    'kode_kanca' => trim($row[0]) ?: null,
                    'kanca' => trim($row[1]) ?: null,
                    'kode_uker' => trim($row[2]) ?: null,
                    'uker' => trim($row[3]) ?: null,
                    'nama_nasabah' => trim($row[4]) ?: null,
                    'cifno' => trim($row[5]) ?: null,
                    'norek_pinjaman' => trim($row[6]) ?: null,
                    'saldo_bulan_lalu' => trim($row[7]) ?: null,
                    'saldo_bulan_berjalan' => trim($row[8]) ?: null,
                    'delta_saldo' => trim($row[9]) ?: null,
                    'nama_rm_pemrakarsa' => trim($row[10]) ?: null,
                    'qcash' => trim($row[11]) ?: null,
                    'qib' => trim($row[12]) ?: null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                $totalRows++;
                
                if (count($batchData) >= $batchSize) {
                    UserAktifCasaKecil::insert($batchData);
                    $batchData = [];
                    $this->output->progressAdvance($batchSize);
                }
            }
            
            if (!empty($batchData)) {
                UserAktifCasaKecil::insert($batchData);
                $this->output->progressAdvance(count($batchData));
            }
            
            fclose($handle);
            $this->output->progressFinish();
            
            DB::commit();
            
            $this->info("\nBerhasil import {$totalRows} data User Aktif Casa Kecil");
            return 0;
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }
}
