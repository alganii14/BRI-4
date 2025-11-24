<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Rekap;

$rekap = Rekap::first();

if (!$rekap) {
    echo "Tidak ada data\n";
    exit;
}

echo "=== Data dalam Database ===\n";
echo "ID: {$rekap->id}\n";
echo "Nama KC: {$rekap->nama_kc}\n";
echo "PN: {$rekap->pn}\n";
echo "Nama RMFT: {$rekap->nama_rmft}\n";
echo "Nama Pemilik: {$rekap->nama_pemilik}\n";
echo "No Rekening: {$rekap->no_rekening}\n";
echo "Pipeline: {$rekap->pipeline}\n";
echo "Realisasi: {$rekap->realisasi}\n";
echo "Keterangan: {$rekap->keterangan}\n";
echo "Validasi: {$rekap->validasi}\n";
