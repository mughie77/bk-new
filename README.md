# Aplikasi Bimbingan dan Konseling (BK) Sekolah

Sistem informasi manajemen bimbingan dan konseling sekolah berbasis web menggunakan PHP Native dengan arsitektur MVC sederhana dan Tailwind CSS.

## Fitur Utama
- **Dashboard Modern:** Visualisasi data ringkas dengan antarmuka profesional.
- **Manajemen Data Master:** CRUD Guru BK, Siswa, dan Kelas.
- **Sistem Mapping:** Penempatan siswa ke kelas dan penugasan Guru BK ke kelas binaan.
- **Laporan Konsultasi:** Pencatatan aktivitas BK dengan fitur anonimitas otomatis.
- **Cetak Laporan Profesional:** Output PDF-ready dengan Kop Surat dinamis dan tanda tangan otomatis.
- **Visualisasi Sosiogram:** Grafik hubungan antar siswa menggunakan `vis.js` yang dapat diunduh sebagai gambar.
- **Update System:** Fitur pembaruan kode via Git dan sinkronisasi database dalam satu klik.

## Persyaratan Sistem
- PHP >= 8.0
- MySQL >= 5.7
- Web Server (Apache/Nginx/Litespeed)
- Mod_Rewrite aktif (untuk `.htaccess`)

## Instruksi Instalasi

1. **Clone Repository / Ekstrak File:**
   Letakkan semua file di direktori root web server Anda (misal: `htdocs` atau `/var/www/html`).

2. **Konfigurasi Database:**
   - Buat database baru di MySQL (misal: `bk_sekolah`).
   - Impor file `config/schema.sql` ke dalam database tersebut.

3. **Pengaturan Aplikasi:**
   - Buka file `config/config.php`.
   - Sesuaikan `BASEURL` dengan URL akses aplikasi Anda (contoh: `http://localhost/bk-sekolah`).
   - Masukkan kredensial database (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`).

4. **Login Default:**
   - **Username:** `admin`
   - **Password:** `admin123`

## Struktur Folder
- `app/`: Berisi logika inti aplikasi (Controllers, Models, Views, Core).
- `config/`: File konfigurasi dan skema database.
- `public/`: Folder publik yang diakses user (index.php, CSS, JS, Gambar).
- `uploads/`: Lokasi penyimpanan file upload seperti Kop Surat.

## Lisensi
Aplikasi ini dikembangkan untuk keperluan manajemen sekolah dengan standar keamanan PDO.
