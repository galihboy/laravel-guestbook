# 📖 Laravel Guestbook

Aplikasi **Buku Tamu** sederhana berbasis **Laravel 9** yang dibuat sebagai proyek latihan pengembangan web menggunakan framework PHP modern. Proyek ini mendemonstrasikan alur kerja CRUD (Create & Read) yang terhubung langsung ke database.

> 🚀 Siap di-deploy ke [Koyeb](https://koyeb.com) menggunakan Docker.

## ✨ Fitur

- Menampilkan daftar pesan tamu (diurutkan dari yang terbaru)
- Menambahkan pesan baru melalui form (Nama, Email, Pesan)
- Validasi input dari sisi server
- Desain responsif menggunakan Tailwind CSS
- Notifikasi pesan berhasil setelah submit
- **Multi-database:** Kompatibel dengan MySQL, MariaDB, dan PostgreSQL

## 🛠️ Teknologi

| Teknologi | Keterangan |
|---|---|
| PHP 8.2 | Bahasa pemrograman |
| Laravel 9 | Framework PHP |
| Tailwind CSS | Styling antarmuka |
| MySQL / MariaDB | Database (lokal) |
| PostgreSQL | Database (cloud/Koyeb) |
| Docker + Apache | Containerisasi untuk deployment |

## 🖥️ Menjalankan Secara Lokal

Pastikan sudah menginstall **PHP 8.x**, **Composer**, dan **MySQL/MariaDB** (misalnya via [Laragon](https://laragon.org/)).

### 1. Clone Repositori

```bash
git clone https://github.com/galihboy/laravel-guestbook.git
cd laravel-guestbook
```

### 2. Install Dependensi

```bash
composer install
```

### 3. Buat File Konfigurasi

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Atur Koneksi Database

Edit file `.env` dan sesuaikan nilai berikut:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tes_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Migrasi

```bash
php artisan migrate
```

### 6. Jalankan Server

```bash
php artisan serve
```

Buka di browser: **[http://localhost:8000](http://localhost:8000)**

---

## ☁️ Deploy ke Koyeb

Proyek ini dilengkapi `Dockerfile` yang sudah di-konfigurasi untuk deployment ke **Koyeb** (mendukung PostgreSQL bawaan Koyeb maupun MySQL eksternal).

### Environment Variables yang Dibutuhkan di Koyeb

| Variable | Nilai |
|---|---|
| `APP_NAME` | `Laravel Guestbook` |
| `APP_ENV` | `production` |
| `APP_KEY` | *(Salin dari file `.env` lokal Anda)* |
| `APP_DEBUG` | `false` |
| `APP_URL` | `https://[nama-app].koyeb.app` |
| `DB_CONNECTION` | `pgsql` *(atau `mysql` jika pakai eksternal)* |
| `DATABASE_URL` | *(URL koneksi dari Koyeb Managed Database)* |

> Script `start.sh` akan otomatis menjalankan `php artisan migrate --force` setiap kali container menyala, sehingga tabel database akan terbuat secara otomatis.

## 📄 Lisensi

Proyek ini menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).
