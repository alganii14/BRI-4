@echo off
echo ========================================
echo Import Qlola Nonaktif CSV
echo ========================================
echo.

if not exist "qlola_Belum ada Qlola atau ada namun nonaktif.csv" (
    echo Error: File "qlola_Belum ada Qlola atau ada namun nonaktif.csv" tidak ditemukan!
    echo Pastikan file CSV ada di folder yang sama dengan file batch ini.
    pause
    exit /b 1
)

echo Memulai import data...
echo.

php artisan import:qlola-nonaktif "qlola_Belum ada Qlola atau ada namun nonaktif.csv"

echo.
echo ========================================
echo Import selesai!
echo ========================================
pause
