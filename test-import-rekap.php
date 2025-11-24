<?php

// Test import CSV untuk debugging
$file = 'validasi.csv';

if (!file_exists($file)) {
    die("File $file tidak ditemukan!\n");
}

echo "=== Testing CSV Import ===\n\n";

$handle = fopen($file, 'r');

// Detect delimiter
$firstLine = fgets($handle);
rewind($handle);

echo "First line: $firstLine\n\n";

$delimiter = ',';
if (substr_count($firstLine, ';') > substr_count($firstLine, ',')) {
    $delimiter = ';';
}

echo "Detected delimiter: '$delimiter'\n\n";

// Read header
$header = fgetcsv($handle, 0, $delimiter);
echo "Header:\n";
print_r($header);
echo "\n";

// Read data rows
$rowNum = 0;
while (($row = fgetcsv($handle, 0, $delimiter)) !== false) {
    $rowNum++;
    echo "Row $rowNum:\n";
    print_r($row);
    echo "Count: " . count($row) . "\n";
    
    // Check if first column is NO
    $offset = 0;
    if (is_numeric($row[0]) && strlen($row[0]) <= 5) {
        echo "First column is NO, skipping it\n";
        $offset = 1;
    }
    
    echo "\nParsed data:\n";
    echo "  nama_kc: " . ($row[$offset + 0] ?? 'NULL') . "\n";
    echo "  pn: " . ($row[$offset + 1] ?? 'NULL') . "\n";
    echo "  nama_rmft: " . ($row[$offset + 2] ?? 'NULL') . "\n";
    echo "  nama_pemilik: " . ($row[$offset + 3] ?? 'NULL') . "\n";
    echo "  no_rekening: " . ($row[$offset + 4] ?? 'NULL') . "\n";
    echo "  pipeline: " . ($row[$offset + 5] ?? 'NULL') . "\n";
    echo "  realisasi: " . ($row[$offset + 6] ?? 'NULL') . "\n";
    echo "  keterangan: " . ($row[$offset + 7] ?? 'NULL') . "\n";
    echo "  validasi: " . ($row[$offset + 8] ?? 'NULL') . "\n";
    echo "\n";
}

fclose($handle);

echo "\n=== Test Complete ===\n";
