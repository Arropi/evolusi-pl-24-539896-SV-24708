# Konstruksi PL - Laravel Application

Projek backend Laravel yang dikonfigurasi untuk integrasi database PostgreSQL (Supabase) dan dilengkapi dengan GitHub Actions CI untuk verifikasi kualitas kode, keamanan dependensi, serta pengujian otomatis siap produksi.

---

## 🛠️ Tech Stack
- **Framework**: [Laravel](https://laravel.com) (PHP 8.2+)
- **Database**: PostgreSQL / [Supabase](https://supabase.com)
- **CI/CD**: GitHub Actions (3 Automated Jobs)

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

## 🤖 GitHub Actions CI Workflow

File workflow terletak pada `.github/workflows/ci.yml`. CI ini berjalan secara otomatis pada event `push` dan `pull_request` ke branch `main`, `master`, dan `develop`.

Workflow ini memiliki **3 Jobs Pengujian**:

| Job | Nama | Deskripsi |
|---|---|---|
| **Job 1** | `code-quality` | Memvalidasi sintaks composer dan menjalankan **Laravel Pint** untuk standarisasi format & gaya kode. |
| **Job 2** | `security-audit` | Memeriksa integritas `composer.lock` dan menjalankan **`composer audit`** untuk mendeteksi kerentanan keamanan dependensi. |
| **Job 3** | `automated-tests` | Menjalankan service container **PostgreSQL 16**, migrasi database (`php artisan migrate`), dan eksekusi test suite (**PHPUnit / Pest**). |

---

## 📤 Langkah Push ke Repositori GitHub

Untuk menghubungkan dan mem-push projek ini ke GitHub Anda:

```bash
# 1. Tambahkan semua file ke staging
git add .

# 2. Buat initial commit
git commit -m "feat: initial laravel project setup with supabase pgsql config and github ci actions"

# 3. Hubungkan ke repositori remote GitHub Anda
git remote add origin https://github.com/<username>/<nama-repo>.git

# 4. Push ke branch main
git push -u origin main
```
