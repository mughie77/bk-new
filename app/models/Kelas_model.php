<?php

class Kelas_model {
    private $table = 'kelas';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllKelas() {
        $this->db->query('SELECT k.*, kk.nama_konsentrasi
                          FROM ' . $this->table . ' k
                          LEFT JOIN konsentrasi_keahlian kk ON k.konsentrasi_id = kk.id
                          ORDER BY k.nama_kelas ASC');
        return $this->db->resultSet();
    }

    public function getKelasPaged($start, $limit) {
        $this->db->query('SELECT k.*, kk.nama_konsentrasi
                          FROM ' . $this->table . ' k
                          LEFT JOIN konsentrasi_keahlian kk ON k.konsentrasi_id = kk.id
                          ORDER BY k.nama_kelas ASC LIMIT :start, :limit');
        $this->db->bind('start', (int)$start, PDO::PARAM_INT);
        $this->db->bind('limit', (int)$limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countKelas() {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table);
        return $this->db->single()['total'];
    }

    public function getKelasById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahKelas($data) {
        $this->db->query('INSERT INTO ' . $this->table . (isset($data['konsentrasi_id']) ? ' (nama_kelas, konsentrasi_id)' : ' (nama_kelas)') . ' VALUES (:nama, :konsentrasi)');
        $this->db->bind('nama', $data['nama_kelas']);
        $this->db->bind('konsentrasi', $data['konsentrasi_id'] ?? null);
        return $this->db->execute();
    }

    public function ubahKelas($data) {
        $this->db->query('UPDATE ' . $this->table . ' SET nama_kelas = :nama, konsentrasi_id = :konsentrasi WHERE id = :id');
        $this->db->bind('nama', $data['nama_kelas']);
        $this->db->bind('konsentrasi', $data['konsentrasi_id']);
        $this->db->bind('id', $data['id']);
        return $this->db->execute();
    }

    public function hapusKelas($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
