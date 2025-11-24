@extends('layouts.app')

@section('title', 'Tambah Merchant Savol')
@section('page-title', 'Tambah Data Merchant Savol Besar Casa Kecil')

@section('content')
<style>
    .form-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 1200px;
        margin: 0 auto;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    input, select, textarea {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    textarea {
        min-height: 100px;
        resize: vertical;
    }

    input:focus, select:focus, textarea:focus {
        outline: none;
        border-color: #667eea;
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
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }

    .error {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
    }
</style>

<div class="form-container">
    <form action="{{ route('merchant-savol.store') }}" method="POST">
        @csrf
        
        <div class="form-grid">
            <div class="form-group">
                <label for="kode_kanca">Kode Kanca</label>
                <input type="text" id="kode_kanca" name="kode_kanca" value="{{ old('kode_kanca') }}">
                @error('kode_kanca')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kanca">Kanca</label>
                <input type="text" id="kanca" name="kanca" value="{{ old('kanca') }}">
                @error('kanca')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kode_uker">Kode Uker</label>
                <input type="text" id="kode_uker" name="kode_uker" value="{{ old('kode_uker') }}">
                @error('kode_uker')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="uker">Uker</label>
                <input type="text" id="uker" name="uker" value="{{ old('uker') }}">
                @error('uker')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jenis_merchant">Jenis Merchant (EDC/QRIS)</label>
                <select id="jenis_merchant" name="jenis_merchant">
                    <option value="">Pilih Jenis Merchant</option>
                    <option value="EDC" {{ old('jenis_merchant') == 'EDC' ? 'selected' : '' }}>EDC</option>
                    <option value="QRIS" {{ old('jenis_merchant') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                </select>
                @error('jenis_merchant')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tid_store_id">TID / Store ID</label>
                <input type="text" id="tid_store_id" name="tid_store_id" value="{{ old('tid_store_id') }}">
                @error('tid_store_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="nama_merchant">Nama Merchant</label>
                <input type="text" id="nama_merchant" name="nama_merchant" value="{{ old('nama_merchant') }}">
                @error('nama_merchant')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="alamat_merchant">Alamat Merchant</label>
                <textarea id="alamat_merchant" name="alamat_merchant">{{ old('alamat_merchant') }}</textarea>
                @error('alamat_merchant')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="norekening">No. Rekening</label>
                <input type="text" id="norekening" name="norekening" value="{{ old('norekening') }}">
                @error('norekening')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cif">CIF</label>
                <input type="text" id="cif" name="cif" value="{{ old('cif') }}">
                @error('cif')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="savol_bulan_lalu">Savol Bulan Lalu</label>
                <input type="text" id="savol_bulan_lalu" name="savol_bulan_lalu" value="{{ old('savol_bulan_lalu') }}">
                @error('savol_bulan_lalu')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="casa_akhir_bulan">CASA Akhir Bulan</label>
                <input type="text" id="casa_akhir_bulan" name="casa_akhir_bulan" value="{{ old('casa_akhir_bulan') }}">
                @error('casa_akhir_bulan')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
            <a href="{{ route('merchant-savol.index') }}" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
@endsection
