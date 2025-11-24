@extends('layouts.app')

@section('title', 'Detail User Aktif Casa Kecil')
@section('page-title', 'Detail Data User Aktif Casa Kecil')

@section('content')
<style>
    .detail-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 1000px;
        margin: 0 auto;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }

    .detail-item {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-label {
        font-weight: 600;
        color: #666;
        font-size: 13px;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 16px;
        color: #333;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
        margin-right: 10px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #333;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .actions {
        display: flex;
        gap: 10px;
    }

    .delta-negative {
        color: #dc3545;
        font-weight: 600;
    }

    .delta-positive {
        color: #28a745;
        font-weight: 600;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #667eea;
        margin: 30px 0 20px 0;
        padding-bottom: 10px;
        border-bottom: 2px solid #667eea;
    }
</style>

<div class="detail-container">
    <div class="section-title">Informasi Unit Kerja</div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Kode Kanca</div>
            <div class="detail-value">{{ $userAktifCasaKecil->kode_kanca ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Kanca</div>
            <div class="detail-value">{{ $userAktifCasaKecil->kanca ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Kode Uker</div>
            <div class="detail-value">{{ $userAktifCasaKecil->kode_uker ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Uker</div>
            <div class="detail-value">{{ $userAktifCasaKecil->uker ?? '-' }}</div>
        </div>
    </div>

    <div class="section-title">Informasi Nasabah</div>
    <div class="detail-grid">
        <div class="detail-item full-width">
            <div class="detail-label">Nama Nasabah</div>
            <div class="detail-value">{{ $userAktifCasaKecil->nama_nasabah ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">CIFNO</div>
            <div class="detail-value">{{ $userAktifCasaKecil->cifno ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Norek Pinjaman</div>
            <div class="detail-value">{{ $userAktifCasaKecil->norek_pinjaman ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Nama RM Pemrakarsa</div>
            <div class="detail-value">{{ $userAktifCasaKecil->nama_rm_pemrakarsa ?? '-' }}</div>
        </div>
    </div>

    <div class="section-title">Informasi Saldo</div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Saldo Bulan Lalu</div>
            <div class="detail-value">{{ $userAktifCasaKecil->saldo_bulan_lalu ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Saldo Bulan Berjalan</div>
            <div class="detail-value">{{ $userAktifCasaKecil->saldo_bulan_berjalan ?? '-' }}</div>
        </div>

        <div class="detail-item full-width">
            <div class="detail-label">Delta Saldo</div>
            <div class="detail-value {{ strpos($userAktifCasaKecil->delta_saldo, '-') === 0 ? 'delta-negative' : 'delta-positive' }}">
                {{ $userAktifCasaKecil->delta_saldo ?? '-' }}
            </div>
        </div>
    </div>

    <div class="section-title">Informasi Lainnya</div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">QCash</div>
            <div class="detail-value">{{ $userAktifCasaKecil->qcash ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">QIB</div>
            <div class="detail-value">{{ $userAktifCasaKecil->qib ?? '-' }}</div>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('user-aktif-casa-kecil.edit', $userAktifCasaKecil->id) }}" class="btn btn-warning">✏️ Edit</a>
        <a href="{{ route('user-aktif-casa-kecil.index') }}" class="btn btn-secondary">↩️ Kembali</a>
    </div>
</div>
@endsection
