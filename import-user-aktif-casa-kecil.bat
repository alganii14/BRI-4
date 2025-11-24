@echo off
echo ========================================
echo Import User Aktif Casa Kecil CSV
echo ========================================
echo.

if not exist "User aktif casa kecil.csv" (
    echo Error: File "User aktif casa kecil.csv" tidak ditemukan!
    echo Pastikan file CSV ada di folder yang sama dengan file batch ini.
    pause
    exit /b 1
)

echo Memulai import data...
echo.

php artisan import:user-aktif-casa-kecil "User aktif casa kecil.csv"

echo.
echo ========================================
echo Import selesai!
echo ========================================
pause
