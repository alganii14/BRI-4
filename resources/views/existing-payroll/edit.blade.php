@extends('layouts.app')

@section('title', 'Edit Existing Payroll')
@section('page-title', 'Edit Data Existing Payroll')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }

    input:focus, textarea:focus {
        outline: none;
        border-color: #667eea;
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

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
</style>

<div class="form-container">
    <form action="{{ route('existing-payroll.update', $existingPayroll->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="kode_cabang_induk">Kode Cabang Induk</label>
            <input type="text" name="kode_cabang_induk" id="kode_cabang_induk" value="{{ old('kode_cabang_induk', $existingPayroll->kode_cabang_induk) }}">
            @error('kode_cabang_induk')
                <span style="color: red; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cabang_induk">Cabang Induk</label>
            <input type="text" name="cabang_induk" id="cabang_induk" value="{{ old('cabang_induk', $existingPayroll->cabang_induk) }}">
            @error('cabang_induk')
                <span style="color: red; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="corporate_code">Corporate Code</label>
            <input type="text" name="corporate_code" id="corporate_code" value="{{ old('corporate_code', $existingPayroll->corporate_code) }}">
            @error('corporate_code')
                <span style="color: red; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama_perusahaan">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan', $existingPayroll->nama_perusahaan) }}">
            @error('nama_perusahaan')
                <span style="color: red; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="jumlah_rekening">Jumlah Rekening</label>
            <input type="text" name="jumlah_rekening" id="jumlah_rekening" value="{{ old('jumlah_rekening', $existingPayroll->jumlah_rekening) }}">
            @error('jumlah_rekening')
                <span style="color: red; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="saldo_rekening">Saldo Rekening</label>
            <input type="text" name="saldo_rekening" id="saldo_rekening" value="{{ old('saldo_rekening', $existingPayroll->saldo_rekening) }}">
            @error('saldo_rekening')
                <span style="color: red; font-size: 13px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                💾 Update
            </button>
            <a href="{{ route('existing-payroll.index') }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>
    </form>
</div>

@endsection
