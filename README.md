# Konstruksi PL - Laravel Application

Projek Fullstack Laravel yang dikonfigurasi untuk integrasi database PostgreSQL (Supabase) dan dilengkapi dengan GitHub Actions CI untuk verifikasi kualitas kode, keamanan dependensi, serta pengujian otomatis siap produksi.

---

## 👾 About this Project
Ini adalah platform untuk mempelajari machine learning dengan menggunakan laravel sebagai backend dan supabase sebagai database. Dengan konsep materi dimulai dari fundamental dengan banyak analogi dan visualisasi untuk mempermudah pemahaman konsep. Serta banyak latihan soal untuk menguji pemahaman konsep dalam bentuk kode.

## 🛠️ Tech Stack
- **Framework**: [Laravel](https://laravel.com) (PHP 8.2+)
- **Database**: PostgreSQL / [Supabase](https://supabase.com)

---

## 🚀 Setup & Instalasi Lokal

1. **Clone repositori** (jika clone dari remote):
   ```bash
   git clone <repository-url>
   cd konstruksi-pl
   ```

2. **Instal dependensi PHP**:
   ```bash
   composer install
   ```

3. **Salin file Environment**:
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi Database Supabase (.env)**:
   Buka file `.env` dan masukkan kredensial database PostgreSQL dari Supabase Anda:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=db.xxxxxxxxxxxxxxxxxxxx.supabase.co
   DB_PORT=5432
   DB_DATABASE=postgres
   DB_USERNAME=postgres
   DB_PASSWORD=your-supabase-db-password
   DB_SSLMODE=require
   ```
   > **Catatan Pooler:** Jika menggunakan Supabase Connection Pooler, gunakan port `6543` (atau `5432` untuk Session Pooler) dan pastikan format username sesuai dengan yang diberikan di dashboard Supabase.

6. **Jalankan Migrasi Database**:
   ```bash
   php artisan migrate
   ```

7. **Jalankan Local Development Server**:
   ```bash
   php artisan serve
   ```

---
