<?php

class Guru extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) $this->redirect('auth');
    }

    public function index() {
        $data['judul'] = 'Data Guru BK';
        $data['guru'] = $this->model('Guru_model')->getAllGuru();
        $this->view('templates/header', $data);
        $this->view('guru/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('Guru_model')->tambahGuru($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Guru BK berhasil ditambah', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menambah data', 'tipe' => 'danger'];
        }
        $this->redirect('guru');
    }

    public function edit($id) {
        $data['judul'] = 'Edit Guru BK';
        $data['guru'] = $this->model('Guru_model')->getGuruById($id);
        $this->view('templates/header', $data);
        $this->view('guru/edit', $data);
        $this->view('templates/footer');
    }

    public function update() {
        if ($this->model('Guru_model')->ubahGuru($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Guru BK berhasil diubah', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal mengubah data', 'tipe' => 'danger'];
        }
        $this->redirect('guru');
    }

    public function hapus($id) {
        if ($this->model('Guru_model')->hapusGuru($id)) {
            $_SESSION['flash'] = ['pesan' => 'Guru BK berhasil dihapus', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menghapus data', 'tipe' => 'danger'];
        }
        $this->redirect('guru');
    }
}
