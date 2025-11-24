@extends('layouts.app')

@section('title', 'Detail Existing Payroll')
@section('page-title', 'Detail Data Existing Payroll')

@section('content')
<style>
    .detail-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .detail-row {
        display: flex;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        width: 200px;
        font-weight: 600;
        color: #555;
    }

    .detail-value {
        flex: 1;
        color: #333;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
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

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
</style>

<div class="detail-container">
    <div class="detail-row">
        <div class="detail-label">Kode Cabang Induk:</div>
        <div class="detail-value">{{ $existingPayroll->kode_cabang_induk ?? '-' }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Cabang Induk:</div>
        <div class="detail-value">{{ $existingPayroll->cabang_induk ?? '-' }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Corporate Code:</div>
        <div class="detail-value">{{ $existingPayroll->corporate_code ?? '-' }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Nama Perusahaan:</div>
        <div class="detail-value">{{ $existingPayroll->nama_perusahaan ?? '-' }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Jumlah Rekening:</div>
        <div class="detail-value">{{ $existingPayroll->jumlah_rekening ?? '-' }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Saldo Rekening:</div>
        <div class="detail-value">{{ $existingPayroll->saldo_rekening ?? '-' }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Dibuat Pada:</div>
        <div class="detail-value">{{ $existingPayroll->created_at->format('d M Y H:i:s') }}</div>
    </div>

    <div class="detail-row">
        <div class="detail-label">Diupdate Pada:</div>
        <div class="detail-value">{{ $existingPayroll->updated_at->format('d M Y H:i:s') }}</div>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('existing-payroll.edit', $existingPayroll->id) }}" class="btn btn-warning">
            ✏️ Edit
        </a>
        <a href="{{ route('existing-payroll.index') }}" class="btn btn-secondary">
            ← Kembali
        </a>
        <form action="{{ route('existing-payroll.destroy', $existingPayroll->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                🗑️ Hapus
            </button>
        </form>
    </div>
</div>

@endsection
