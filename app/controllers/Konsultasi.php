<?php

class Konsultasi extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) $this->redirect('auth');
    }

    public function index($p = 1) {
        $limit = 10;
        $start = ($p > 1) ? ($p * $limit) - $limit : 0;

        $data['judul'] = 'Laporan Konsultasi';
        $data['konsultasi'] = $this->model('Konsultasi_model')->getKonsultasiPaged($start, $limit);
        $total = $this->model('Konsultasi_model')->countKonsultasi();

        $data['halaman_aktif'] = $p;
        $data['total_halaman'] = ceil($total / $limit);
        $data['siswa'] = $this->model('Siswa_model')->getAllSiswa();

        $this->view('templates/header', $data);
        $this->view('konsultasi/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('Konsultasi_model')->tambahKonsultasi($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Laporan konsultasi berhasil disimpan', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menyimpan laporan', 'tipe' => 'danger'];
        }
        $this->redirect('konsultasi');
    }

    public function cetak($id) {
        $data['judul'] = 'Cetak Laporan Konsultasi';
        $data['konsultasi'] = $this->model('Konsultasi_model')->getKonsultasiById($id);
        $data['pengaturan'] = $this->model('Pengaturan_model')->getPengaturan();

        $this->view('konsultasi/cetak', $data);
    }

    public function hapus($id) {
        if ($this->model('Konsultasi_model')->hapusKonsultasi($id)) {
            $_SESSION['flash'] = ['pesan' => 'Laporan berhasil dihapus', 'tipe' => 'success'];
        }
        $this->redirect('konsultasi');
    }

    public function get_guru_by_siswa($id) {
        $guru = $this->model('Mapping_model')->getGuruBySiswaId($id);
        header('Content-Type: application/json');
        echo json_encode($guru ? $guru : ['nama_guru' => '']);
    }
}
