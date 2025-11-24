<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class PotensiPayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = base_path('Potensi Payroll.csv');

        if (!file_exists($csvFile)) {
            $this->command->error('File Potensi Payroll.csv tidak ditemukan!');
            return;
        }

        $this->command->info('Memulai import data Potensi Payroll...');

        try {
            $handle = fopen($csvFile, 'r');
            $header = fgetcsv($handle, 1000, ';'); // Skip header row
            
            $batch = [];
            $batchSize = 1000;
            $totalInserted = 0;

            while (($row = fgetcsv($handle, 1000, ';')) !== false) {
                // Skip rows with empty perusahaan
                if (count($row) >= 5 && !empty(trim($row[3]))) {
                    $batch[] = [
                        'no' => trim($row[0]) ?: null,
                        'kode_cabang_induk' => trim($row[1]) ?: null,
                        'cabang_induk' => trim($row[2]) ?: null,
                        'perusahaan' => trim($row[3]) ?: null,
                        'estimasi_pekerja' => trim($row[4]) ?: null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    if (count($batch) >= $batchSize) {
                        DB::table('potensi_payrolls')->insert($batch);
                        $totalInserted += count($batch);
                        $this->command->info("Imported {$totalInserted} rows...");
                        $batch = [];
                    }
                }
            }

            // Insert remaining batch
            if (!empty($batch)) {
                DB::table('potensi_payrolls')->insert($batch);
                $totalInserted += count($batch);
            }

            fclose($handle);

            $this->command->info("✓ Import berhasil! Total data: {$totalInserted} baris");

        } catch (\Exception $e) {
            $this->command->error('✗ Gagal mengimport CSV: ' . $e->getMessage());
        }
    }
}
