<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QlolaNonDebitur extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kanca',
        'kanca',
        'kode_uker',
        'uker',
        'cifno',
        'no_rekening',
        'nama_nasabah',
        'segmentasi',
        'cek_qcash',
        'cek_cms',
        'cek_ib',
        'keterangan',
    ];
}
