-- Database: bk_sekolah

CREATE TABLE IF NOT EXISTS pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    peran ENUM('Admin', 'Guru BK') DEFAULT 'Guru BK'
);

CREATE TABLE IF NOT EXISTS pengaturan_sekolah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_sekolah VARCHAR(255) NOT NULL,
    kop_surat VARCHAR(255),
    semester ENUM('Ganjil', 'Genap') NOT NULL,
    tahun_pelajaran VARCHAR(20) NOT NULL,
    nama_kepala_sekolah VARCHAR(255) NOT NULL,
    nip_kepala_sekolah VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS konsentrasi_keahlian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_konsentrasi VARCHAR(255) NOT NULL,
    singkatan VARCHAR(10) NOT NULL
);

CREATE TABLE IF NOT EXISTS guru_bk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(50) NOT NULL UNIQUE,
    nama_guru VARCHAR(255) NOT NULL,
    pengguna_id INT,
    FOREIGN KEY (pengguna_id) REFERENCES pengguna(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(20) NOT NULL UNIQUE,
    nisn VARCHAR(20) NOT NULL UNIQUE,
    nama_siswa VARCHAR(255) NOT NULL,
    tahun_masuk YEAR
);

CREATE TABLE IF NOT EXISTS kelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(100) NOT NULL,
    konsentrasi_id INT,
    FOREIGN KEY (konsentrasi_id) REFERENCES konsentrasi_keahlian(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS mapping_siswa_kelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT,
    kelas_id INT,
    tahun_ajaran VARCHAR(20),
    nomor_urut INT,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS mapping_kelas_guru (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kelas_id INT,
    guru_id INT,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE,
    FOREIGN KEY (guru_id) REFERENCES guru_bk(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS konsultasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_id INT,
    guru_id INT,
    tanggal DATE NOT NULL,
    waktu_menit INT NOT NULL,
    topik TEXT NOT NULL,
    konsultan VARCHAR(255),
    peran_konselor VARCHAR(255),
    is_anonim BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (guru_id) REFERENCES guru_bk(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS sosiogram (
    id INT AUTO_INCREMENT PRIMARY KEY,
    siswa_sumber_id INT,
    siswa_target_id INT,
    relasi VARCHAR(100),
    kelas_id INT,
    FOREIGN KEY (siswa_sumber_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (siswa_target_id) REFERENCES siswa(id) ON DELETE CASCADE,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE
);

-- Data Awal Pengguna (password: admin123)
INSERT INTO pengguna (username, password, nama_lengkap, peran) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'Admin');

-- Data Awal Pengaturan
INSERT INTO pengaturan_sekolah (nama_sekolah, semester, tahun_pelajaran, nama_kepala_sekolah) VALUES
('SMK Negeri Contoh', 'Ganjil', '2023/2024', 'Drs. Nama Kepala Sekolah, M.Pd.');
