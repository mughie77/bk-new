<?php

class Siswa_model {
    private $table = 'siswa';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllSiswa() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getSiswaById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahSiswa($data) {
        $this->db->query('INSERT INTO ' . $this->table . ' (nis, nisn, nama_siswa) VALUES (:nis, :nisn, :nama)');
        $this->db->bind('nis', $data['nis']);
        $this->db->bind('nisn', $data['nisn']);
        $this->db->bind('nama', $data['nama_siswa']);
        return $this->db->execute();
    }

    public function ubahSiswa($data) {
        $this->db->query('UPDATE ' . $this->table . ' SET nis = :nis, nisn = :nisn, nama_siswa = :nama WHERE id = :id');
        $this->db->bind('nis', $data['nis']);
        $this->db->bind('nisn', $data['nisn']);
        $this->db->bind('nama', $data['nama_siswa']);
        $this->db->bind('id', $data['id']);
        return $this->db->execute();
    }

    public function hapusSiswa($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
