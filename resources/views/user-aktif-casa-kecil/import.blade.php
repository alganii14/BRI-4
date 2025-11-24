@extends('layouts.app')

@section('title', 'Import CSV User Aktif Casa Kecil')
@section('page-title', 'Import CSV User Aktif Casa Kecil')

@section('content')
<style>
    .import-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .form-group input[type="file"] {
        width: 100%;
        padding: 12px;
        border: 2px dashed #ddd;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: border-color 0.3s;
    }

    .form-group input[type="file"]:hover {
        border-color: #667eea;
    }

    .btn {
        padding: 10px 24px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .info-box {
        background-color: #e7f3ff;
        border: 1px solid #b3d9ff;
        border-radius: 6px;
        padding: 16px;
        margin-bottom: 24px;
    }

    .info-box h4 {
        margin-top: 0;
        color: #0066cc;
        font-size: 16px;
    }

    .info-box ul {
        margin: 8px 0 0 20px;
        color: #333;
    }

    .info-box li {
        margin-bottom: 4px;
    }

    .alert {
        padding: 12px 20px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
</style>

<div class="import-container">
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="info-box">
        <h4>📋 Format CSV yang Diperlukan</h4>
        <ul>
            <li>File harus dalam format CSV dengan delimiter <strong>semicolon (;)</strong></li>
            <li>Header (baris pertama) akan diabaikan</li>
            <li>Kolom yang diperlukan (urutan harus sesuai):
                <ol style="margin-top: 8px;">
                    <li>KODE KANCA</li>
                    <li>KANCA</li>
                    <li>KODE UKER</li>
                    <li>UKER</li>
                    <li>NAMA NASABAH</li>
                    <li>CIFNO</li>
                    <li>NOREK PINJAMAN</li>
                    <li>SALDO BULAN LALU</li>
                    <li>SALDO BULAN BERJALAN</li>
                    <li>DELTA SALDO</li>
                    <li>NAMA RM PEMRAKARSA</li>
                    <li>QCASH</li>
                    <li>QIB</li>
                </ol>
            </li>
            <li>Data akan diimpor dalam batch 1000 baris</li>
        </ul>
    </div>

    <form action="{{ route('user-aktif-casa-kecil.import') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="csv_file">Pilih File CSV <span style="color: red;">*</span></label>
            <input type="file" name="csv_file" id="csv_file" accept=".csv,.txt" required>
            @error('csv_file')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                📤 Upload & Import
            </button>
            <a href="{{ route('user-aktif-casa-kecil.index') }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>
    </form>
</div>
@endsection
