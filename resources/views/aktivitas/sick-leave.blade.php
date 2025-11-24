@extends('layouts.app')

@section('title', 'Tandai Sakit/Izin')
@section('page-title', 'Tandai Sakit/Izin')

@section('content')
<style>
    .sick-leave-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #FF6B6B 0%, #EE5A52 100%);
        color: white;
        padding: 24px 32px;
        border: none;
    }

    .card-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }

    .card-header p {
        margin: 8px 0 0 0;
        opacity: 0.95;
        font-size: 15px;
    }

    .card-body {
        padding: 32px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-label .required {
        color: #FF6B6B;
        margin-left: 4px;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #FF6B6B;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
    }

    .form-control:hover, .form-select:hover {
        border-color: #FFB3B3;
    }

    .form-text {
        display: block;
        margin-top: 6px;
        font-size: 13px;
        color: #666;
    }

    .info-box {
        background: linear-gradient(135deg, #E3F2FD 0%, #BBDEFB 100%);
        border-left: 4px solid #2196F3;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .info-box-title {
        font-weight: 700;
        color: #1565C0;
        margin-bottom: 12px;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-box ul {
        margin: 0;
        padding-left: 20px;
        color: #1565C0;
    }

    .info-box li {
        margin-bottom: 6px;
        font-size: 14px;
        line-height: 1.6;
    }

    .info-box li:last-child {
        margin-bottom: 0;
    }

    .btn-group {
        display: flex;
        gap: 12px;
        margin-top: 32px;
    }

    .btn {
        padding: 12px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #FF6B6B 0%, #EE5A52 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
    }

    .btn-secondary {
        background: white;
        border: 2px solid #6c757d;
        color: #6c757d;
    }

    .btn-secondary:hover {
        background: #6c757d;
        color: white;
        border-color: #6c757d;
    }

    .alert {
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 24px;
        border: none;
    }

    .alert-danger {
        background: linear-gradient(135deg, #FFEBEE 0%, #FFCDD2 100%);
        color: #C62828;
        border-left: 4px solid #EF5350;
    }

    .icon {
        width: 20px;
        height: 20px;
    }
</style>

<div class="sick-leave-container">
    @if(session('error'))
        <div class="alert alert-danger">
            <strong>⚠️ Error:</strong> {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>🏥 Tandai Aktivitas Sakit/Izin</h3>
            <p>Tandai semua aktivitas pada tanggal tertentu sebagai Sakit atau Izin</p>
        </div>

        <div class="card-body">
            <form action="{{ route('aktivitas.sick-leave.process') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="tanggal" class="form-label">
                        Tanggal<span class="required">*</span>
                    </label>
                    <input type="date" 
                           class="form-control @error('tanggal') is-invalid @enderror" 
                           id="tanggal" 
                           name="tanggal" 
                           value="{{ old('tanggal', date('Y-m-d')) }}" 
                           required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text">Pilih tanggal untuk menandai semua aktivitas pada tanggal tersebut</small>
                </div>

                <div class="form-group">
                    <label for="keterangan" class="form-label">
                        Keterangan<span class="required">*</span>
                    </label>
                    <select class="form-select @error('keterangan') is-invalid @enderror" 
                            id="keterangan" 
                            name="keterangan" 
                            required>
                        <option value="">-- Pilih Keterangan --</option>
                        <option value="Sakit" {{ old('keterangan') == 'Sakit' ? 'selected' : '' }}>😷 Sakit</option>
                        <option value="Izin" {{ old('keterangan') == 'Izin' ? 'selected' : '' }}>📋 Izin</option>
                    </select>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text">Pilih apakah Sakit atau Izin</small>
                </div>

                <div class="info-box">
                    <div class="info-box-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                        Informasi Penting
                    </div>
                    <ul>
                        <li>Semua aktivitas pada tanggal yang dipilih akan ditandai dengan keterangan yang Anda pilih</li>
                        <li>Status realisasi akan diubah menjadi <strong>"Tidak Tercapai"</strong></li>
                        <li>Nominal realisasi akan diisi <strong>0 (nol)</strong></li>
                        <li>Hanya aktivitas yang <strong>belum memiliki feedback</strong> yang akan diupdate</li>
                    </ul>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        Tandai Aktivitas
                    </button>
                    <a href="{{ route('aktivitas.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
