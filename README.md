# Aplikasi Bimbingan dan Konseling (BK) Sekolah

Aplikasi berbasis web untuk mengelola data bimbingan dan konseling siswa, penugasan guru BK ke kelas, laporan konsultasi, dan visualisasi sosiogram.

## Fitur Utama
1. **Dashboard:** Ringkasan data sekolah.
2. **Data Master:** CRUD Guru BK (NIP, Nama), Siswa, dan Kelas.
3. **Mapping:** Penugasan Siswa ke Kelas dan Kelas ke Guru BK.
4. **Laporan Konsultasi:** Pencatatan konsultasi dengan fitur anonimitas dan cetak laporan profesional (Kop Surat, TTD NIP).
5. **Sosiogram:** Visualisasi jejaring sosial siswa dalam satu kelas menggunakan `vis.js` dan fitur download graf.
6. **Update Otomatis:** Fitur pembaruan kode aplikasi langsung dari GitHub melalui menu Pengaturan.
7. **Update Database:** Sinkronisasi skema database melalui menu Pengaturan.

## Tech Stack
- **Backend:** PHP Native (PDO)
- **Frontend:** HTML5, Tailwind CSS (CDN)
- **Database:** MySQL
- **Libraries:** vis.js, html2canvas, FontAwesome

## Langkah Instalasi

1. **Persiapan Database:**
   - Buat database baru di MySQL dengan nama `bk_sekolah`.
   - Import file `config/schema.sql` yang tersedia di folder config ke dalam database tersebut.

2. **Konfigurasi Aplikasi:**
   - Buka file `config/config.php`.
   - Sesuaikan nilai `BASEURL` dengan alamat folder project Anda (misal: `http://localhost/bk-sekolah/public`).
   - Sesuaikan konfigurasi database (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`) jika berbeda.
   - Sesuaikan `GIT_URL` dengan alamat repository GitHub Anda.

3. **Web Server:**
   - Pastikan modul `mod_rewrite` di Apache aktif (untuk mendukung `.htaccess`).
   - Arahkan *Document Root* web server ke folder `public/` atau akses melalui `localhost/bk-sekolah/public`.

4. **Login Default:**
   - **Username:** `admin`
   - **Password:** `admin123`
   - **Login Guru:** Gunakan NIP yang didaftarkan.

## Fitur Update
- **Update Kode:** Tombol ini akan melakukan `git fetch` dan `git reset` ke origin/master. Jika folder bukan repository git, aplikasi akan mencoba melakukan inisialisasi otomatis menggunakan `GIT_URL`.
- **Update Database:** Tombol ini akan menjalankan perintah SQL dari `config/schema.sql`.

## Struktur Folder
- `app/`: Berisi logika inti aplikasi (MVC).
- `config/`: Konfigurasi dan skema database.
- `public/`: Folder publik (Entry point).
- `uploads/`: Lokasi penyimpanan file kop surat.
