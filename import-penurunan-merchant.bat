@echo off
echo ========================================
echo Import Penurunan CASA Merchant (QRIS ^& EDC)
echo ========================================
echo.

REM Cek apakah file CSV ada
if not exist "PENURUNAN MERCHANT.csv" (
    echo ERROR: File "PENURUNAN MERCHANT.csv" tidak ditemukan!
    echo Pastikan file CSV ada di folder yang sama dengan file .bat ini
    pause
    exit /b 1
)

echo File CSV ditemukan: PENURUNAN MERCHANT.csv
echo.
echo Memulai import...
echo.

REM Jalankan command import
php artisan import:penurunan-merchant "PENURUNAN MERCHANT.csv"

echo.
echo ========================================
echo Import selesai!
echo ========================================
pause
