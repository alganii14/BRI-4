@extends('layouts.app')

@section('title', 'Detail Perusahaan Anak')
@section('page-title', 'Detail Data Perusahaan Anak')

@section('content')
<style>
    .detail-container {
        background: white;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 1000px;
        margin: 0 auto;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .detail-label {
        font-weight: 600;
        color: #555;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-value {
        padding: 12px 0;
        color: #333;
        border-bottom: 1px solid #f0f0f0;
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
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid #f0f0f0;
    }

    .status-badge {
        padding: 6px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        display: inline-block;
    }

    .status-terakuisisi {
        background-color: #d4edda;
        color: #155724;
    }

    .status-belum {
        background-color: #fff3cd;
        color: #856404;
    }
</style>

<div class="detail-container">
    <div class="detail-grid">
        <div class="detail-label">Nama Partner/Vendor</div>
        <div class="detail-value">{{ $perusahaanAnak->nama_partner_vendor ?: '-' }}</div>

        <div class="detail-label">Jenis Usaha</div>
        <div class="detail-value">{{ $perusahaanAnak->jenis_usaha ?: '-' }}</div>

        <div class="detail-label">Alamat</div>
        <div class="detail-value">{{ $perusahaanAnak->alamat ?: '-' }}</div>

        <div class="detail-label">Kode Cabang Induk</div>
        <div class="detail-value">{{ $perusahaanAnak->kode_cabang_induk ?: '-' }}</div>

        <div class="detail-label">Cabang Induk Terdekat</div>
        <div class="detail-value">{{ $perusahaanAnak->cabang_induk_terdekat ?: '-' }}</div>

        <div class="detail-label">Nama PIC Partner</div>
        <div class="detail-value">{{ $perusahaanAnak->nama_pic_partner ?: '-' }}</div>

        <div class="detail-label">Posisi PIC Partner</div>
        <div class="detail-value">{{ $perusahaanAnak->posisi_pic_partner ?: '-' }}</div>

        <div class="detail-label">HP PIC Partner</div>
        <div class="detail-value">{{ $perusahaanAnak->hp_pic_partner ?: '-' }}</div>

        <div class="detail-label">Nama Perusahaan Anak</div>
        <div class="detail-value">{{ $perusahaanAnak->nama_perusahaan_anak ?: '-' }}</div>

        <div class="detail-label">Status Pipeline</div>
        <div class="detail-value">
            @if(stripos($perusahaanAnak->status_pipeline, 'Sudah') !== false)
                <span class="status-badge status-terakuisisi">{{ $perusahaanAnak->status_pipeline }}</span>
            @else
                <span class="status-badge status-belum">{{ $perusahaanAnak->status_pipeline ?: '-' }}</span>
            @endif
        </div>

        <div class="detail-label">Dibuat Pada</div>
        <div class="detail-value">{{ $perusahaanAnak->created_at ? $perusahaanAnak->created_at->format('d-m-Y H:i:s') : '-' }}</div>

        <div class="detail-label">Diupdate Pada</div>
        <div class="detail-value">{{ $perusahaanAnak->updated_at ? $perusahaanAnak->updated_at->format('d-m-Y H:i:s') : '-' }}</div>
    </div>

    <div class="actions">
        <a href="{{ route('perusahaan-anak.edit', $perusahaanAnak->id) }}" class="btn btn-warning">✏️ Edit</a>
        <a href="{{ route('perusahaan-anak.index') }}" class="btn btn-secondary">↩️ Kembali</a>
    </div>
</div>
@endsection
