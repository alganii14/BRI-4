<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Rekap;

echo "=== Testing Actual Import to Database ===\n\n";

$file = 'validasi.csv';
$handle = fopen($file, 'r');

// Detect delimiter
$firstLine = fgets($handle);
rewind($handle);

$delimiter = ',';
if (substr_count($firstLine, ';') > substr_count($firstLine, ',')) {
    $delimiter = ';';
}

echo "Delimiter: '$delimiter'\n\n";

// Skip header
$header = fgetcsv($handle, 0, $delimiter);

$imported = 0;
while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
    // Skip empty rows
    if (empty(array_filter($row))) continue;
    
    if (count($row) < 9) {
        echo "Row skipped - not enough columns\n";
        continue;
    }
    
    // Check if first column is NO
    $offset = 0;
    if (is_numeric($row[0]) && strlen($row[0]) <= 5) {
        echo "First column is NO, offset = 1\n";
        $offset = 1;
    }
    
    $pipeline = str_replace(['.', ',', ' '], '', $row[$offset + 5]);
    $realisasi = str_replace(['.', ',', ' '], '', $row[$offset + 6]);
    
    $data = [
        'nama_kc' => trim($row[$offset + 0] ?? ''),
        'pn' => trim($row[$offset + 1] ?? ''),
        'nama_rmft' => trim($row[$offset + 2] ?? ''),
        'nama_pemilik' => trim($row[$offset + 3] ?? ''),
        'no_rekening' => trim($row[$offset + 4] ?? ''),
        'pipeline' => is_numeric($pipeline) ? (float)$pipeline : 0,
        'realisasi' => is_numeric($realisasi) ? (float)$realisasi : 0,
        'keterangan' => trim($row[$offset + 7] ?? ''),
        'validasi' => $row[$offset + 8] ?? null,
    ];
    
    echo "Importing:\n";
    print_r($data);
    
    try {
        $rekap = Rekap::create($data);
        echo "✓ Success! ID: {$rekap->id}\n\n";
        $imported++;
    } catch (\Exception $e) {
        echo "✗ Error: " . $e->getMessage() . "\n\n";
    }
}

fclose($handle);

echo "\n=== Import Complete ===\n";
echo "Total imported: $imported\n";
