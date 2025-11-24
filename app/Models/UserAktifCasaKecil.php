<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAktifCasaKecil extends Model
{
    use HasFactory;

    protected $table = 'user_aktif_casa_kecils';

    protected $fillable = [
        'kode_kanca',
        'kanca',
        'kode_uker',
        'uker',
        'nama_nasabah',
        'cifno',
        'norek_pinjaman',
        'saldo_bulan_lalu',
        'saldo_bulan_berjalan',
        'delta_saldo',
        'nama_rm_pemrakarsa',
        'qcash',
        'qib',
    ];
}
