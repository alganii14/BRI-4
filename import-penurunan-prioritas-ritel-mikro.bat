@echo off
echo ======================================
echo Import Penurunan Prioritas Ritel ^& Mikro
echo ======================================
echo.

REM Check if CSV file exists
if not exist "penurunan prioritas ritel dan mikro.csv" (
    echo ERROR: File "penurunan prioritas ritel dan mikro.csv" tidak ditemukan!
    echo Pastikan file CSV ada di folder yang sama dengan batch file ini.
    echo.
    pause
    exit /b 1
)

echo Menghapus data lama...
php artisan db:seed --class=DeletePenurunanPrioritasRitelMikroSeeder
timeout /t 2

echo.
echo Mengimport data dari CSV...
echo File: penurunan prioritas ritel dan mikro.csv
echo.

REM Menggunakan curl untuk mengirim file ke endpoint import
curl -X POST http://localhost/aktivitas_pipeline/public/penurunan-prioritas-ritel-mikro/import ^
     -F "csv_file=@penurunan prioritas ritel dan mikro.csv" ^
     -H "Content-Type: multipart/form-data"

echo.
echo.
echo ======================================
echo Import selesai!
echo ======================================
echo.
pause
