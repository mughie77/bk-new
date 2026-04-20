<?php

class Konsultasi_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllKonsultasi() {
        $this->db->query('SELECT k.*, s.nama_siswa, s.nis, kl.nama_kelas
                          FROM konsultasi k
                          JOIN siswa s ON k.siswa_id = s.id
                          LEFT JOIN mapping_siswa_kelas msk ON s.id = msk.siswa_id
                          LEFT JOIN kelas kl ON msk.kelas_id = kl.id
                          ORDER BY k.tanggal DESC');
        return $this->db->resultSet();
    }

    public function getKonsultasiById($id) {
        $this->db->query('SELECT k.*, s.nama_siswa, s.nis, kl.nama_kelas, kk.nama_konsentrasi
                          FROM konsultasi k
                          JOIN siswa s ON k.siswa_id = s.id
                          LEFT JOIN mapping_siswa_kelas msk ON s.id = msk.siswa_id
                          LEFT JOIN kelas kl ON msk.kelas_id = kl.id
                          LEFT JOIN konsentrasi_keahlian kk ON kl.konsentrasi_id = kk.id
                          WHERE k.id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahKonsultasi($data) {
        // Cari guru_id dari tabel guru_bk berdasarkan pengguna_id yang sedang login
        $this->db->query('SELECT id FROM guru_bk WHERE pengguna_id = :pengguna_id');
        $this->db->bind('pengguna_id', $_SESSION['user_id']);
        $guru = $this->db->single();
        $guru_id = $guru ? $guru['id'] : null;

        $this->db->query('INSERT INTO konsultasi (siswa_id, guru_id, tanggal, waktu_menit, topik, konsultan, peran_konselor, is_anonim)
                          VALUES (:siswa_id, :guru_id, :tanggal, :waktu_menit, :topik, :konsultan, :peran_konselor, :is_anonim)');
        $this->db->bind('siswa_id', $data['siswa_id']);
        $this->db->bind('guru_id', $guru_id);
        $this->db->bind('tanggal', $data['tanggal']);
        $this->db->bind('waktu_menit', $data['waktu_menit']);
        $this->db->bind('topik', $data['topik']);
        $this->db->bind('konsultan', $data['konsultan']);
        $this->db->bind('peran_konselor', $data['peran_konselor']);
        $this->db->bind('is_anonim', isset($data['is_anonim']) ? 1 : 0);
        return $this->db->execute();
    }

    public function hapusKonsultasi($id) {
        $this->db->query('DELETE FROM konsultasi WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
