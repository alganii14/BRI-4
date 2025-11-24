@extends('layouts.app')

@section('title', 'Detail Penurunan Prioritas Ritel & Mikro')
@section('page-title', 'Detail Data Penurunan Prioritas Ritel & Mikro')

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
</style>

<div class="detail-container">
    <div class="detail-grid">
        <div class="detail-item">
            <div class="detail-label">Kode Cabang Induk</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->kode_cabang_induk ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Cabang Induk</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->cabang_induk ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Kode Uker</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->kode_uker ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Unit Kerja</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->unit_kerja ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">CIFNO</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->cifno ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">No Rekening</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->no_rekening ?? '-' }}</div>
        </div>

        <div class="detail-item full-width">
            <div class="detail-label">Nama Nasabah</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->nama_nasabah ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Segmentasi BPR</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->segmentasi_bpr ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Jenis Simpanan</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->jenis_simpanan ?? '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Saldo Last EOM</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->saldo_last_eom ? number_format($penurunanPrioritasRitelMikro->saldo_last_eom, 2, ',', '.') : '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Saldo Terupdate</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->saldo_terupdate ? number_format($penurunanPrioritasRitelMikro->saldo_terupdate, 2, ',', '.') : '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Delta</div>
            <div class="detail-value {{ $penurunanPrioritasRitelMikro->delta < 0 ? 'delta-negative' : 'delta-positive' }}">
                {{ $penurunanPrioritasRitelMikro->delta ? number_format($penurunanPrioritasRitelMikro->delta, 2, ',', '.') : '-' }}
            </div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Dibuat Pada</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->created_at ? $penurunanPrioritasRitelMikro->created_at->format('d/m/Y H:i') : '-' }}</div>
        </div>

        <div class="detail-item">
            <div class="detail-label">Terakhir Diupdate</div>
            <div class="detail-value">{{ $penurunanPrioritasRitelMikro->updated_at ? $penurunanPrioritasRitelMikro->updated_at->format('d/m/Y H:i') : '-' }}</div>
        </div>
    </div>

    <div class="actions">
        <a href="{{ route('penurunan-prioritas-ritel-mikro.edit', $penurunanPrioritasRitelMikro->id) }}" class="btn btn-warning">
            ✏️ Edit
        </a>
        <a href="{{ route('penurunan-prioritas-ritel-mikro.index') }}" class="btn btn-secondary">
            ↩️ Kembali
        </a>
    </div>
</div>
@endsection
