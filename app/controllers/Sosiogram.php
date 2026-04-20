<?php

class Sosiogram extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) $this->redirect('auth');
    }

    public function index($kelas_id = null) {
        $data['judul'] = 'Sosiogram Siswa';
        $data['kelas'] = $this->model('Kelas_model')->getAllKelas();
        $data['selected_kelas'] = $kelas_id;
        $data['relasi'] = $kelas_id ? $this->model('Sosiogram_model')->getRelasiByKelas($kelas_id) : [];
        $data['siswa_di_kelas'] = $kelas_id ? $this->model('Mapping_model')->getSiswaByKelas($kelas_id) : [];

        $this->view('templates/header', $data);
        $this->view('sosiogram/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('Sosiogram_model')->tambahRelasi($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Relasi sosiogram berhasil ditambah', 'tipe' => 'success'];
        }
        $this->redirect('sosiogram/index/' . $_POST['kelas_id']);
    }

    public function hapus($id, $kelas_id) {
        if ($this->model('Sosiogram_model')->hapusRelasi($id)) {
            $_SESSION['flash'] = ['pesan' => 'Relasi berhasil dihapus', 'tipe' => 'success'];
        }
        $this->redirect('sosiogram/index/' . $kelas_id);
    }
}
