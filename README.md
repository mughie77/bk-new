# Aplikasi Bimbingan dan Konseling (BK) Sekolah

Aplikasi berbasis web untuk mengelola data bimbingan dan konseling siswa, penugasan guru BK ke kelas, laporan konsultasi, dan visualisasi sosiogram.

## Fitur Utama
- **Dashboard:** Ringkasan data sekolah.
- **Data Master:** CRUD Guru BK, Siswa, dan Kelas.
- **Mapping:** Penugasan Siswa ke Kelas dan Kelas ke Guru BK.
- **Laporan Konsultasi:** Pencatatan konsultasi dengan fitur anonimitas dan cetak PDF/Laporan.
- **Sosiogram:** Visualisasi jejaring sosial siswa dalam satu kelas menggunakan `vis.js` dan fitur download graf.

## Tech Stack
- **Backend:** PHP Native (PDO)
- **Frontend:** HTML5, Tailwind CSS (CDN)
- **Database:** MySQL
- **Libraries:** vis.js, html2canvas, FontAwesome

## Langkah Instalasi

1. **Persiapan Database:**
   - Buat database baru di MySQL dengan nama `bk_sekolah`.
   - Import file `schema.sql` yang tersedia di root folder ke dalam database tersebut.

2. **Konfigurasi Aplikasi:**
   - Buka file `config/config.php`.
   - Sesuaikan nilai `BASEURL` dengan alamat folder project Anda (misal: `http://localhost/bk-sekolah/public`).
   - Sesuaikan konfigurasi database (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`) jika berbeda.

3. **Web Server:**
   - Pastikan modul `mod_rewrite` di Apache aktif (untuk mendukung `.htaccess`).
   - Arahkan *Document Root* web server ke folder `public/` atau akses melalui `localhost/bk-sekolah/public`.

4. **Login Default:**
   - **Username:** `admin`
   - **Password:** `admin123`

## Struktur Folder
- `app/`: Berisi logika inti aplikasi (MVC).
  - `controllers/`: Logika alur aplikasi.
  - `models/`: Interaksi dengan database.
  - `views/`: Antarmuka pengguna (UI).
  - `core/`: Kelas inti (App, Controller, Database).
- `config/`: File konfigurasi.
- `public/`: Folder publik yang diakses user (Entry point).
- `uploads/`: Lokasi penyimpanan file kop surat.
