<?php

namespace App\Console\Commands;

use App\Models\QlolaNonaktif;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportQlolaNonaktif extends Command
{
    protected $signature = 'import:qlola-nonaktif {file}';
    protected $description = 'Import Qlola Nonaktif data from CSV file';

    public function handle()
    {
        $filePath = $this->argument('file');
        
        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        $this->info('Memulai import data Qlola Nonaktif...');
        
        DB::beginTransaction();
        try {
            $handle = fopen($filePath, 'r');
            $header = fgetcsv($handle, 0, ';');
            
            $batchData = [];
            $batchSize = 1000;
            $totalRows = 0;
            
            $this->output->progressStart();
            
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (count($row) < 11) continue;
                
                $batchData[] = [
                    'kode_kanca' => trim($row[0]),
                    'kanca' => trim($row[1]),
                    'kode_uker' => trim($row[2]),
                    'uker' => trim($row[3]),
                    'cifno' => trim($row[4]),
                    'norek_pinjaman' => trim($row[5]),
                    'norek_simpanan' => trim($row[6]),
                    'nama_debitur' => trim($row[7]),
                    'plafon' => trim($row[8]),
                    'pn_pengelola' => trim($row[9]),
                    'keterangan' => trim($row[10]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                
                $totalRows++;
                
                if (count($batchData) >= $batchSize) {
                    QlolaNonaktif::insert($batchData);
                    $batchData = [];
                    $this->output->progressAdvance($batchSize);
                }
            }
            
            if (!empty($batchData)) {
                QlolaNonaktif::insert($batchData);
                $this->output->progressAdvance(count($batchData));
            }
            
            fclose($handle);
            $this->output->progressFinish();
            
            DB::commit();
            
            $this->info("\nBerhasil import {$totalRows} data Qlola Nonaktif");
            return 0;
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }
}
