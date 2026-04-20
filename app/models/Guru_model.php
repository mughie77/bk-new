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

    public function tambahGuru($data) {
        try {
            // 1. Buat user di tabel pengguna
            $this->db->query('INSERT INTO pengguna (username, password, nama_lengkap, peran) VALUES (:username, :password, :nama, "Guru BK")');
            $this->db->bind('username', $data['nip']);
            $this->db->bind('password', password_hash($data['nip'], PASSWORD_DEFAULT)); // Default password adalah NIP
            $this->db->bind('nama', $data['nama_guru']);
            $this->db->execute();
            $pengguna_id = $this->db->lastInsertId();

            // 2. Buat data guru
            $this->db->query('INSERT INTO ' . $this->table . ' (nip, nama_guru, pengguna_id) VALUES (:nip, :nama, :pengguna_id)');
            $this->db->bind('nip', $data['nip']);
            $this->db->bind('nama', $data['nama_guru']);
            $this->db->bind('pengguna_id', $pengguna_id);
            return $this->db->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function ubahGuru($data) {
        $guru_lama = $this->getGuruById($data['id']);

        // Update data guru
        $this->db->query('UPDATE ' . $this->table . ' SET nip = :nip, nama_guru = :nama WHERE id = :id');
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('nama', $data['nama_guru']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();

        // Update username di tabel pengguna jika ada
        if ($guru_lama['pengguna_id']) {
            $this->db->query('UPDATE pengguna SET username = :nip, nama_lengkap = :nama WHERE id = :id');
            $this->db->bind('nip', $data['nip']);
            $this->db->bind('nama', $data['nama_guru']);
            $this->db->bind('id', $guru_lama['pengguna_id']);
            return $this->db->execute();
        }
        return true;
    }

    public function hapusGuru($id) {
        $guru = $this->getGuruById($id);
        if ($guru['pengguna_id']) {
            $this->db->query('DELETE FROM pengguna WHERE id = :id');
            $this->db->bind('id', $guru['pengguna_id']);
            $this->db->execute();
        }

        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
