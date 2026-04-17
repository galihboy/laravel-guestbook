#!/bin/bash

# Pastikan script berhenti jika ada error
set -e

echo "Memulai proses setup untuk container Koyeb..."

# Jalankan migrasi database paksa (karena ini environment production)
# Ini akan otomatis menyesuaikan dengan koneksi database di ENV (MySQL atau PostgreSQL)
echo "Menjalankan migrasi database..."
php artisan migrate --force

echo "Memulai Apache server..."
apache2-foreground
