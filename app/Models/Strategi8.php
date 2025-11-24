<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strategi8 extends Model
{
    use HasFactory;

    protected $table = 'strategi8';

    protected $fillable = [
        'regional_office',
        'kode_cabang_induk',
        'cabang_induk',
        'kode_uker',
        'unit_kerja',
        'cifno',
        'no_rekening',
        'ytd',
        'product_type',
        'nama_nasabah',
        'jenis_nasabah',
        'segmentasi_bpr',
        'jenis_simpanan',
        'saldo_last_eom',
        'saldo_terupdate',
        'delta',
    ];
}
