@echo off
REM Batch file untuk import data AUM DPK dari CSV
REM Usage: import-aum.bat

echo ========================================
echo Import Data AUM DPK (AUM^>2M DPK^<50 juta)
echo ========================================
echo.

REM Check if AUM.csv exists
if not exist "AUM.csv" (
    echo ERROR: File AUM.csv tidak ditemukan!
    echo Pastikan file AUM.csv ada di folder yang sama dengan batch file ini.
    echo.
    pause
    exit /b 1
)

echo File AUM.csv ditemukan
echo.

REM Ask for confirmation
set /p confirm="Apakah Anda yakin ingin mengimport data AUM DPK? (Y/N): "
if /i not "%confirm%"=="Y" (
    echo Import dibatalkan.
    echo.
    pause
    exit /b 0
)

echo.
echo Memulai import...
echo.

REM Run PHP artisan command to import
php artisan db:seed --class=AumDpkSeeder

if %ERRORLEVEL% EQU 0 (
    echo.
    echo ========================================
    echo Import berhasil!
    echo ========================================
    echo.
) else (
    echo.
    echo ========================================
    echo Import gagal! Error code: %ERRORLEVEL%
    echo ========================================
    echo.
)

pause
