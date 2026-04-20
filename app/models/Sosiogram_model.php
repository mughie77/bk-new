<?php

class Sosiogram_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getRelasiByKelas($kelas_id) {
        $this->db->query('SELECT s.*, s1.nama_siswa as sumber, s2.nama_siswa as target
                          FROM sosiogram s
                          JOIN siswa s1 ON s.siswa_sumber_id = s1.id
                          JOIN siswa s2 ON s.siswa_target_id = s2.id
                          WHERE s.kelas_id = :kelas_id');
        $this->db->bind('kelas_id', $kelas_id);
        return $this->db->resultSet();
    }

    public function tambahRelasi($data) {
        $this->db->query('INSERT INTO sosiogram (siswa_sumber_id, siswa_target_id, relasi, kelas_id)
                          VALUES (:sumber, :target, :relasi, :kelas_id)');
        $this->db->bind('sumber', $data['siswa_sumber_id']);
        $this->db->bind('target', $data['siswa_target_id']);
        $this->db->bind('relasi', $data['relasi']);
        $this->db->bind('kelas_id', $data['kelas_id']);
        return $this->db->execute();
    }

    public function hapusRelasi($id) {
        $this->db->query('DELETE FROM sosiogram WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
