<?php

class Guru_model {
    private $table = 'guru_bk';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllGuru() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getGuruById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getGuruByPenggunaId($pengguna_id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE pengguna_id = :pengguna_id');
        $this->db->bind('pengguna_id', $pengguna_id);
        return $this->db->single();
    }

    public function tambahGuru($data) {
        $this->db->query('INSERT INTO ' . $this->table . ' (nama_guru) VALUES (:nama)');
        $this->db->bind('nama', $data['nama_guru']);
        return $this->db->execute();
    }

    public function ubahGuru($data) {
        $this->db->query('UPDATE ' . $this->table . ' SET nama_guru = :nama WHERE id = :id');
        $this->db->bind('nama', $data['nama_guru']);
        $this->db->bind('id', $data['id']);
        return $this->db->execute();
    }

    public function hapusGuru($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
