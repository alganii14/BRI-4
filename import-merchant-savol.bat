@echo off
echo Importing Merchant Savol Besar Casa Kecil...
cd /d %~dp0
php artisan migrate --path=database/migrations/2025_11_19_000000_create_merchant_savols_table.php
echo Migration completed!
pause
