@echo off
echo ========================================
echo Import Qlola Non Debitur
echo ========================================
echo.

REM Cek apakah file CSV ada
if not exist "Qlola Non debitur.csv" (
    echo ERROR: File "Qlola Non debitur.csv" tidak ditemukan!
    echo Pastikan file CSV ada di folder yang sama dengan file .bat ini
    pause
    exit /b 1
)

echo File CSV ditemukan: Qlola Non debitur.csv
echo.
echo Memulai import...
echo.

REM Jalankan command import
php artisan import:qlola-non-debitur "Qlola Non debitur.csv"

echo.
echo ========================================
echo Import selesai!
echo ========================================
pause
