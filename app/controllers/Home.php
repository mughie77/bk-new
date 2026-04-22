<?php

class Home extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard - Aplikasi BK';
        $data['user'] = $_SESSION['nama'];

        $data['total_siswa'] = $this->model('Siswa_model')->countSiswa();
        $data['total_konsultasi'] = $this->model('Konsultasi_model')->countKonsultasi();
        $data['total_relasi'] = $this->model('Sosiogram_model')->countTotalRelasi();

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
