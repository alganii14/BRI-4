@extends('layouts.app')

@section('title', 'Detail Merchant Savol')
@section('page-title', 'Detail Data Merchant Savol Besar Casa Kecil')

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
    <div class="section-title">Informasi Kantor</div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Kode Kanca</div>
            <div class="detail-value">{{ $merchantSavol->kode_kanca ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Kanca</div>
            <div class="detail-value">{{ $merchantSavol->kanca ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Kode Uker</div>
            <div class="detail-value">{{ $merchantSavol->kode_uker ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Uker</div>
            <div class="detail-value">{{ $merchantSavol->uker ?? '-' }}</div>
        </div>
    </div>

    <div class="section-title">Informasi Merchant</div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Jenis Merchant</div>
            <div class="detail-value">{{ $merchantSavol->jenis_merchant ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">TID / Store ID</div>
            <div class="detail-value">{{ $merchantSavol->tid_store_id ?? '-' }}</div>
        </div>

        <div class="detail-item full-width">
            <div class="detail-label">Nama Merchant</div>
            <div class="detail-value">{{ $merchantSavol->nama_merchant ?? '-' }}</div>
        </div>

        <div class="detail-item full-width">
            <div class="detail-label">Alamat Merchant</div>
            <div class="detail-value">{{ $merchantSavol->alamat_merchant ?? '-' }}</div>
        </div>
    </div>

    <div class="section-title">Informasi Rekening</div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">No. Rekening</div>
            <div class="detail-value">{{ $merchantSavol->norekening ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">CIF</div>
            <div class="detail-value">{{ $merchantSavol->cif ?? '-' }}</div>
        </div>
    </div>

    <div class="section-title">Informasi Transaksi & Saldo</div>
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Savol Bulan Lalu</div>
            <div class="detail-value">{{ $merchantSavol->savol_bulan_lalu ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">CASA Akhir Bulan</div>
            <div class="detail-value">{{ $merchantSavol->casa_akhir_bulan ?? '-' }}</div>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('merchant-savol.edit', $merchantSavol->id) }}" class="btn btn-warning">✏️ Edit</a>
        <a href="{{ route('merchant-savol.index') }}" class="btn btn-secondary">↩️ Kembali</a>
    </div>
</div>
@endsection
