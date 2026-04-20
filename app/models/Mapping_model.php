<?php

class Mapping_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mapping Siswa ke Kelas
    public function getSiswaByKelas($kelas_id) {
        $this->db->query('SELECT s.*, msk.id as mapping_id
                          FROM siswa s
                          JOIN mapping_siswa_kelas msk ON s.id = msk.siswa_id
                          WHERE msk.kelas_id = :kelas_id');
        $this->db->bind('kelas_id', $kelas_id);
        return $this->db->resultSet();
    }

    public function getSiswaTanpaKelas() {
        $this->db->query('SELECT * FROM siswa WHERE id NOT IN (SELECT siswa_id FROM mapping_siswa_kelas)');
        return $this->db->resultSet();
    }

    public function tambahMappingSiswa($data) {
        $this->db->query('INSERT INTO mapping_siswa_kelas (siswa_id, kelas_id) VALUES (:siswa_id, :kelas_id)');
        $this->db->bind('siswa_id', $data['siswa_id']);
        $this->db->bind('kelas_id', $data['kelas_id']);
        return $this->db->execute();
    }

    public function hapusMappingSiswa($id) {
        $this->db->query('DELETE FROM mapping_siswa_kelas WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    // Mapping Kelas ke Guru BK
    public function getMappingGuru() {
        $this->db->query('SELECT mkg.*, k.nama_kelas, g.nama_guru
                          FROM mapping_kelas_guru mkg
                          JOIN kelas k ON mkg.kelas_id = k.id
                          JOIN guru_bk g ON mkg.guru_id = g.id');
        return $this->db->resultSet();
    }

    public function tambahMappingGuru($data) {
        $this->db->query('INSERT INTO mapping_kelas_guru (kelas_id, guru_id) VALUES (:kelas_id, :guru_id)');
        $this->db->bind('kelas_id', $data['kelas_id']);
        $this->db->bind('guru_id', $data['guru_id']);
        return $this->db->execute();
    }

    public function hapusMappingGuru($id) {
        $this->db->query('DELETE FROM mapping_kelas_guru WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
