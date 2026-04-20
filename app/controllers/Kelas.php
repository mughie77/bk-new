<?php

class Kelas extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) $this->redirect('auth');
    }

    public function index() {
        $data['judul'] = 'Data Kelas';
        $data['kelas'] = $this->model('Kelas_model')->getAllKelas();
        $data['konsentrasi'] = $this->model('Pengaturan_model')->getAllKonsentrasi();
        $this->view('templates/header', $data);
        $this->view('kelas/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('Kelas_model')->tambahKelas($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Kelas berhasil ditambah', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menambah data', 'tipe' => 'danger'];
        }
        $this->redirect('kelas');
    }

    public function edit($id) {
        $data['judul'] = 'Edit Kelas';
        $data['kelas'] = $this->model('Kelas_model')->getKelasById($id);
        $data['konsentrasi'] = $this->model('Pengaturan_model')->getAllKonsentrasi();
        $this->view('templates/header', $data);
        $this->view('kelas/edit', $data);
        $this->view('templates/footer');
    }

    public function update() {
        if ($this->model('Kelas_model')->ubahKelas($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Data kelas berhasil diubah', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal mengubah data', 'tipe' => 'danger'];
        }
        $this->redirect('kelas');
    }

    public function hapus($id) {
        if ($this->model('Kelas_model')->hapusKelas($id)) {
            $_SESSION['flash'] = ['pesan' => 'Kelas berhasil dihapus', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menghapus data', 'tipe' => 'danger'];
        }
        $this->redirect('kelas');
    }
}
