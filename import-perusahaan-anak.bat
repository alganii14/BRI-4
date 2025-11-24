@echo off
php artisan migrate --path=database/migrations/2025_11_18_create_perusahaan_anaks_table.php
timeout /t 3
