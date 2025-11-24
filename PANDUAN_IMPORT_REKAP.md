# Panduan Import Data Rekap

## Format Data yang Benar

Data rekap harus memiliki kolom-kolom berikut **TANPA kolom NO**:

| Nama KC | PN | Nama RMFT | Nama Pemilik | No Rekening | Pipeline | Realisasi | Keterangan | Validasi |
|---------|-------|-----------|--------------|-------------|----------|-----------|------------|----------|
| KC Kuningan | 282247 | Adam Nugraha | Andi Prasetyo | 1234567890 | 150000000 | 120000000 | Realisasi sesuai target | Approved |
| KC Sumedang | 254416 | ANDRI PURNAMA | Budi Santoso | 0987654321 | 200000000 | 180000000 | Cross selling produk | Pending |

## Cara Import Data

### Metode 1: Menggunakan Template (Recommended)

1. Login sebagai Manager atau Admin
2. Buka menu **Validasi** di sidebar
3. Klik tombol **📥 Import Data**
4. Klik tombol **📥 Download Template CSV**
5. Buka file template yang didownload
6. Isi data sesuai format (jangan ubah header)
7. Simpan file
8. Upload file di form import
9. Klik **Import Data**

### Metode 2: Membuat File Sendiri

#### Format Excel (.xlsx, .xls)
1. Buat file Excel baru
2. Baris pertama (header): `Nama KC | PN | Nama RMFT | Nama Pemilik | No Rekening | Pipeline | Realisasi | Keterangan | Validasi`
3. Isi data mulai dari baris kedua
4. **JANGAN tambahkan kolom NO** - nomor urut akan otomatis dibuat oleh sistem
5. Simpan file
6. Import melalui menu Validasi

#### Format CSV (.csv)
1. Buat file CSV dengan separator koma (,)
2. Baris pertama (header): `Nama KC,PN,Nama RMFT,Nama Pemilik,No Rekening,Pipeline,Realisasi,Keterangan,Validasi`
3. Isi data mulai dari baris kedua
4. Encoding: UTF-8
5. Import melalui menu Validasi

## Contoh Data yang Benar

```csv
Nama KC,PN,Nama RMFT,Nama Pemilik,No Rekening,Pipeline,Realisasi,Keterangan,Validasi
KC Kuningan,282247,Adam Nugraha,Andi Prasetyo,1234567890,150000000,120000000,Realisasi sesuai target,Approved
KC Sumedang,254416,ANDRI PURNAMA,Budi Santoso,0987654321,200000000,180000000,Cross selling produk,Pending
```

## Catatan Penting

1. **Kolom NO tidak diperlukan** - Sistem akan otomatis membuat nomor urut
2. **Pipeline dan Realisasi** harus berupa angka (tanpa Rp, titik, atau koma)
3. **Maksimal ukuran file**: 10MB
4. **Format yang didukung**: .xlsx, .xls, .csv
5. Jika file memiliki kolom NO di awal, sistem akan otomatis skip kolom tersebut

## Troubleshooting

### Data masuk ke kolom yang salah
- Pastikan file tidak memiliki kolom NO di awal
- Atau gunakan template yang disediakan sistem

### Error saat import
- Periksa format file (harus .xlsx, .xls, atau .csv)
- Pastikan ukuran file tidak melebihi 10MB
- Periksa encoding file (harus UTF-8 untuk CSV)

### Data tidak sesuai
- Hapus semua data menggunakan tombol "Hapus Semua Data" (Admin only)
- Import ulang dengan file yang benar

## Data Contoh Sudah Tersedia

Sistem sudah dilengkapi dengan 5 data contoh yang bisa Anda lihat sebagai referensi:
- KC Sumedang - ANDRI PURNAMA
- KC Kuningan - Adam Nugraha (4 data)

Anda bisa melihat data ini di halaman Validasi untuk memahami format yang benar.
