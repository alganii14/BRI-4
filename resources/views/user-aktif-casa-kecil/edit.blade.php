@extends('layouts.app')

@section('title', 'Edit User Aktif Casa Kecil')
@section('page-title', 'Edit Data User Aktif Casa Kecil')

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
    <form action="{{ route('user-aktif-casa-kecil.update', $userAktifCasaKecil->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="form-group">
                <label for="kode_kanca">Kode Kanca</label>
                <input type="text" id="kode_kanca" name="kode_kanca" value="{{ old('kode_kanca', $userAktifCasaKecil->kode_kanca) }}">
                @error('kode_kanca')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kanca">Kanca</label>
                <input type="text" id="kanca" name="kanca" value="{{ old('kanca', $userAktifCasaKecil->kanca) }}">
                @error('kanca')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kode_uker">Kode Uker</label>
                <input type="text" id="kode_uker" name="kode_uker" value="{{ old('kode_uker', $userAktifCasaKecil->kode_uker) }}">
                @error('kode_uker')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="uker">Uker</label>
                <input type="text" id="uker" name="uker" value="{{ old('uker', $userAktifCasaKecil->uker) }}">
                @error('uker')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="nama_nasabah">Nama Nasabah</label>
                <input type="text" id="nama_nasabah" name="nama_nasabah" value="{{ old('nama_nasabah', $userAktifCasaKecil->nama_nasabah) }}">
                @error('nama_nasabah')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cifno">CIFNO</label>
                <input type="text" id="cifno" name="cifno" value="{{ old('cifno', $userAktifCasaKecil->cifno) }}">
                @error('cifno')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="norek_pinjaman">Norek Pinjaman</label>
                <input type="text" id="norek_pinjaman" name="norek_pinjaman" value="{{ old('norek_pinjaman', $userAktifCasaKecil->norek_pinjaman) }}">
                @error('norek_pinjaman')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="saldo_bulan_lalu">Saldo Bulan Lalu</label>
                <input type="text" id="saldo_bulan_lalu" name="saldo_bulan_lalu" value="{{ old('saldo_bulan_lalu', $userAktifCasaKecil->saldo_bulan_lalu) }}">
                @error('saldo_bulan_lalu')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="saldo_bulan_berjalan">Saldo Bulan Berjalan</label>
                <input type="text" id="saldo_bulan_berjalan" name="saldo_bulan_berjalan" value="{{ old('saldo_bulan_berjalan', $userAktifCasaKecil->saldo_bulan_berjalan) }}">
                @error('saldo_bulan_berjalan')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="delta_saldo">Delta Saldo</label>
                <input type="text" id="delta_saldo" name="delta_saldo" value="{{ old('delta_saldo', $userAktifCasaKecil->delta_saldo) }}">
                @error('delta_saldo')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama_rm_pemrakarsa">Nama RM Pemrakarsa</label>
                <input type="text" id="nama_rm_pemrakarsa" name="nama_rm_pemrakarsa" value="{{ old('nama_rm_pemrakarsa', $userAktifCasaKecil->nama_rm_pemrakarsa) }}">
                @error('nama_rm_pemrakarsa')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="qcash">QCash</label>
                <input type="text" id="qcash" name="qcash" value="{{ old('qcash', $userAktifCasaKecil->qcash) }}">
                @error('qcash')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="qib">QIB</label>
                <input type="text" id="qib" name="qib" value="{{ old('qib', $userAktifCasaKecil->qib) }}">
                @error('qib')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Update</button>
            <a href="{{ route('user-aktif-casa-kecil.index') }}" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
@endsection
