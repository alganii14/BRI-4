<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportOptimalisasiBusinessCluster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimalisasi-business-cluster:import {file=optimalisasi bisuness cluster.csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Optimalisasi Business Cluster data from CSV file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan: {$filePath}");
            return 1;
        }

        $this->info("Membaca file: {$filePath}");

        try {
            DB::beginTransaction();

            $handle = fopen($filePath, 'r');
            
            // Read first line to detect delimiter
            $firstLine = fgets($handle);
            rewind($handle);
            
            // Detect delimiter (semicolon or comma)
            $delimiter = (strpos($firstLine, ';') !== false) ? ';' : ',';
            
            $this->info("Delimiter terdeteksi: " . ($delimiter === ';' ? 'semicolon (;)' : 'comma (,)'));
            
            $header = fgetcsv($handle, 0, $delimiter); // Skip header row
            $this->info("Header: " . implode(' | ', $header));

            $batch = [];
            $batchSize = 1000;
            $totalInserted = 0;
            $lineNumber = 1;

            $progressBar = $this->output->createProgressBar();
            $progressBar->start();

            while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
                $lineNumber++;
                
                if (count($row) >= 8 && !empty(array_filter($row))) {
                    $batch[] = [
                        'kode_cabang_induk' => trim($row[0]) ?: null,
                        'cabang_induk' => trim($row[1]) ?: null,
                        'kode_uker' => trim($row[2]) ?: null,
                        'unit_kerja' => trim($row[3]) ?: null,
                        'tag_zona_unggulan' => trim($row[4]) ?: null,
                        'nomor_rekening' => trim($row[5]) ?: null,
                        'nama_usaha_pusat_bisnis' => trim($row[6]) ?: null,
                        'nama_tenaga_pemasar' => trim($row[7]) ?: null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    if (count($batch) >= $batchSize) {
                        DB::table('optimalisasi_business_clusters')->insert($batch);
                        $totalInserted += count($batch);
                        $progressBar->advance(count($batch));
                        $batch = [];
                    }
                }
            }

            // Insert remaining batch
            if (!empty($batch)) {
                DB::table('optimalisasi_business_clusters')->insert($batch);
                $totalInserted += count($batch);
                $progressBar->advance(count($batch));
            }

            fclose($handle);
            $progressBar->finish();
            $this->newLine();

            DB::commit();

            $this->info("✓ Import berhasil!");
            $this->info("Total data yang diimport: " . number_format($totalInserted, 0, ',', '.') . " baris");

            return 0;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("✗ Gagal mengimport CSV: " . $e->getMessage());
            $this->error("Line: " . $e->getLine());
            $this->error("File: " . $e->getFile());
            return 1;
        }
    }
}
