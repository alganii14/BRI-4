@echo off
REM Import CSV Potensi Payroll ke Database

echo ========================================
echo Import Data Potensi Payroll
echo ========================================
echo.

REM Set lokasi file CSV
set CSV_FILE=Potensi Payroll.csv

REM Cek apakah file CSV ada
if not exist "%CSV_FILE%" (
    echo ERROR: File "%CSV_FILE%" tidak ditemukan!
    echo Pastikan file CSV ada di folder yang sama dengan script ini.
    pause
    exit /b 1
)

echo File CSV ditemukan: %CSV_FILE%
echo.

REM Jalankan artisan command untuk import
echo Memulai proses import...
php artisan db:seed --class=PotensiPayrollSeeder

echo.
echo ========================================
echo Import selesai!
echo ========================================
pause
