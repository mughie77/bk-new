<?php

class Siswa extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) $this->redirect('auth');
    }

    public function index($p = 1) {
        $limit = 10;
        $start = ($p > 1) ? ($p * $limit) - $limit : 0;

        $data['judul'] = 'Data Siswa';
        $data['siswa'] = $this->model('Siswa_model')->getSiswaPaged($start, $limit);
        $total = $this->model('Siswa_model')->countSiswa();

        $data['halaman_aktif'] = $p;
        $data['total_halaman'] = ceil($total / $limit);

        $this->view('templates/header', $data);
        $this->view('siswa/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('Siswa_model')->tambahSiswa($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Siswa berhasil ditambah', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menambah data', 'tipe' => 'danger'];
        }
        $this->redirect('siswa');
    }

    public function edit($id) {
        $data['judul'] = 'Edit Siswa';
        $data['siswa'] = $this->model('Siswa_model')->getSiswaById($id);
        $this->view('templates/header', $data);
        $this->view('siswa/edit', $data);
        $this->view('templates/footer');
    }

    public function update() {
        if ($this->model('Siswa_model')->ubahSiswa($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Data siswa berhasil diubah', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal mengubah data', 'tipe' => 'danger'];
        }
        $this->redirect('siswa');
    }

    public function hapus($id) {
        if ($this->model('Siswa_model')->hapusSiswa($id)) {
            $_SESSION['flash'] = ['pesan' => 'Siswa berhasil dihapus', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menghapus data', 'tipe' => 'danger'];
        }
        $this->redirect('siswa');
    }
}
