<?php

class Pengaturan_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPengaturan() {
        $this->db->query('SELECT * FROM pengaturan_sekolah LIMIT 1');
        return $this->db->single();
    }

    public function updatePengaturan($data, $file = null) {
        $query = "UPDATE pengaturan_sekolah SET
                    nama_sekolah = :nama_sekolah,
                    semester = :semester,
                    tahun_pelajaran = :tahun_pelajaran,
                    nama_kepala_sekolah = :nama_kepala_sekolah,
                    nip_kepala_sekolah = :nip_kepala_sekolah";

        if ($file && $file['name']) {
            $query .= ", kop_surat = :kop_surat";
        }

        $query .= " WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama_sekolah', $data['nama_sekolah']);
        $this->db->bind('semester', $data['semester']);
        $this->db->bind('tahun_pelajaran', $data['tahun_pelajaran']);
        $this->db->bind('nama_kepala_sekolah', $data['nama_kepala_sekolah']);
        $this->db->bind('nip_kepala_sekolah', $data['nip_kepala_sekolah']);
        $this->db->bind('id', $data['id']);

        if ($file && $file['name']) {
            $this->db->bind('kop_surat', $file['name']);
        }

        return $this->db->execute();
    }

    // Konsentrasi Keahlian
    public function getAllKonsentrasi() {
        $this->db->query('SELECT * FROM konsentrasi_keahlian');
        return $this->db->resultSet();
    }

    public function getKonsentrasiById($id) {
        $this->db->query('SELECT * FROM konsentrasi_keahlian WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahKonsentrasi($nama) {
        $this->db->query('INSERT INTO konsentrasi_keahlian (nama_konsentrasi) VALUES (:nama)');
        $this->db->bind('nama', $nama);
        return $this->db->execute();
    }

    public function ubahKonsentrasi($id, $nama) {
        $this->db->query('UPDATE konsentrasi_keahlian SET nama_konsentrasi = :nama WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->bind('nama', $nama);
        return $this->db->execute();
    }

    public function hapusKonsentrasi($id) {
        $this->db->query('DELETE FROM konsentrasi_keahlian WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
