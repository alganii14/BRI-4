@extends('layouts.app')

@section('title', 'Edit Penurunan Prioritas Ritel & Mikro')
@section('page-title', 'Edit Data Penurunan Prioritas Ritel & Mikro')

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
    <form action="{{ route('penurunan-prioritas-ritel-mikro.update', $penurunanPrioritasRitelMikro->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="form-group">
                <label for="kode_cabang_induk">Kode Cabang Induk</label>
                <input type="text" id="kode_cabang_induk" name="kode_cabang_induk" value="{{ old('kode_cabang_induk', $penurunanPrioritasRitelMikro->kode_cabang_induk) }}">
                @error('kode_cabang_induk')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cabang_induk">Cabang Induk</label>
                <input type="text" id="cabang_induk" name="cabang_induk" value="{{ old('cabang_induk', $penurunanPrioritasRitelMikro->cabang_induk) }}">
                @error('cabang_induk')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kode_uker">Kode Uker</label>
                <input type="text" id="kode_uker" name="kode_uker" value="{{ old('kode_uker', $penurunanPrioritasRitelMikro->kode_uker) }}">
                @error('kode_uker')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="unit_kerja">Unit Kerja</label>
                <input type="text" id="unit_kerja" name="unit_kerja" value="{{ old('unit_kerja', $penurunanPrioritasRitelMikro->unit_kerja) }}">
                @error('unit_kerja')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cifno">CIFNO</label>
                <input type="text" id="cifno" name="cifno" value="{{ old('cifno', $penurunanPrioritasRitelMikro->cifno) }}">
                @error('cifno')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_rekening">No Rekening</label>
                <input type="text" id="no_rekening" name="no_rekening" value="{{ old('no_rekening', $penurunanPrioritasRitelMikro->no_rekening) }}">
                @error('no_rekening')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="nama_nasabah">Nama Nasabah</label>
                <input type="text" id="nama_nasabah" name="nama_nasabah" value="{{ old('nama_nasabah', $penurunanPrioritasRitelMikro->nama_nasabah) }}">
                @error('nama_nasabah')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="segmentasi_bpr">Segmentasi BPR</label>
                <input type="text" id="segmentasi_bpr" name="segmentasi_bpr" value="{{ old('segmentasi_bpr', $penurunanPrioritasRitelMikro->segmentasi_bpr) }}">
                @error('segmentasi_bpr')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jenis_simpanan">Jenis Simpanan</label>
                <input type="text" id="jenis_simpanan" name="jenis_simpanan" value="{{ old('jenis_simpanan', $penurunanPrioritasRitelMikro->jenis_simpanan) }}">
                @error('jenis_simpanan')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="saldo_last_eom">Saldo Last EOM</label>
                <input type="number" step="0.01" id="saldo_last_eom" name="saldo_last_eom" value="{{ old('saldo_last_eom', $penurunanPrioritasRitelMikro->saldo_last_eom) }}">
                @error('saldo_last_eom')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="saldo_terupdate">Saldo Terupdate</label>
                <input type="number" step="0.01" id="saldo_terupdate" name="saldo_terupdate" value="{{ old('saldo_terupdate', $penurunanPrioritasRitelMikro->saldo_terupdate) }}">
                @error('saldo_terupdate')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="delta">Delta</label>
                <input type="number" step="0.01" id="delta" name="delta" value="{{ old('delta', $penurunanPrioritasRitelMikro->delta) }}">
                @error('delta')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">💾 Update</button>
            <a href="{{ route('penurunan-prioritas-ritel-mikro.index') }}" class="btn btn-secondary">↩️ Kembali</a>
        </div>
    </form>
</div>
@endsection
