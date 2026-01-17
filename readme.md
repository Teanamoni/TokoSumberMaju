📦 Company Profile

Proyek ini adalah aplikasi web yang dibangun menggunakan Laravel sebagai backend dan Laravel UI untuk frontend. Fungsinya adalah sebagai sistem manajemen untuk katalog produk dan informasi perusahaan (Company Profile).

✨ Fitur Utama

Master Data: Pengelolaan Kelompok Produk, Kategori, dan Produk.

Admin Panel: Antarmuka terpisah untuk manajemen sistem.

Teknologi Modern: Dibangun di atas Laravel 11.

🚀 Persyaratan Sistem

Pastikan lingkungan lokal Anda memenuhi persyaratan berikut:

Persyaratan

Versi Minimum

Catatan

PHP

8.1+

Diperlukan oleh Laravel 11.

Composer

Terbaru

Manajer dependensi PHP.

Node.js & NPM

LTS

Untuk aset frontend (Laravel Mix).

Database

MySQL/MariaDB

Disarankan menggunakan Laragon, XAMPP, atau Docker.

# 🛠️ Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di komputer lokal Anda.

# 1. Kloning Repositori

Kloning proyek ke direktori lokal Anda:

```bash
git clone https://github.com/Syahrul-Fajar/Company-Profile.git
cd Company-profile
```

# 2. Instalasi Dependensi PHP

Gunakan Composer untuk menginstal semua dependensi backend:
```bash
composer install
```

# 3. Konfigurasi Lingkungan (.env)

Salin file contoh lingkungan dan buat kunci aplikasi:
```bash
cp .env.example .env
php artisan key:generate
```

# 4. Konfigurasi Database

Buka file .env dan perbarui detail koneksi database Anda:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=company_profile_db # Ganti dengan nama database yang Anda buat
DB_USERNAME=root 
DB_PASSWORD=
```

Pastikan Anda telah membuat database yang sesuai di server database Anda.

# 5. Migrasi dan Seeder

Jalankan migrasi untuk membuat semua tabel di database:

Untuk menghapus semua tabel dan membuat ulang (disarankan untuk fresh install)
```bash
php artisan migrate:fresh --seed
```

ATAU, jika ingin menjalankan migrasi yang tertunda saja:
```bash
php artisan migrate
```

# 6. Instalasi dan Kompilasi Aset Frontend

Proyek ini menggunakan Laravel Mix. Instal dan kompilasi aset frontend:

Instal dependensi Node.js
```bash
npm install
```

# ▶️ Menjalankan Aplikasi

Jalankan server pengembangan bawaan Laravel:
```bash
php artisan serve
```

Akses aplikasi Anda di browser melalui: http://127.0.0.1:8000

# 🔐 Akses Admin Panel
```bash
Admin panel dapat diakses melalui rute /admin.

URL Admin: http://127.0.0.1:8000/admin

Kredensial Login: (Gunakan akun yang dibuat oleh seeder Anda, jika ada.)
Username: sumbermaju@gmail.com
Password: password
```
🤝 Kontribusi & Lisensi

📝 Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan ajukan Pull Request atau buat Issue baru.

📄 Lisensi

Proyek ini dirilis di bawah lisensi MIT.
