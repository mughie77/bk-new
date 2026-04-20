<?php

class Pengaturan extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) $this->redirect('auth');
    }

    public function index() {
        $data['judul'] = 'Pengaturan - Aplikasi BK';
        $data['pengaturan'] = $this->model('Pengaturan_model')->getPengaturan();
        $data['konsentrasi'] = $this->model('Pengaturan_model')->getAllKonsentrasi();

        $this->view('templates/header', $data);
        $this->view('pengaturan/index', $data);
        $this->view('templates/footer');
    }

    public function update() {
        $file = $_FILES['kop_surat'];
        $upload_ok = true;

        if ($file['name']) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                $_SESSION['flash'] = ['pesan' => 'Ekstensi file kop surat tidak valid (Hanya .jpg, .png)', 'tipe' => 'danger'];
                $upload_ok = false;
            } else {
                move_uploaded_file($file['tmp_name'], '../public/uploads/' . $file['name']);
            }
        }

        if ($upload_ok) {
            if ($this->model('Pengaturan_model')->updatePengaturan($_POST, $file)) {
                $_SESSION['flash'] = ['pesan' => 'Pengaturan berhasil diperbarui', 'tipe' => 'success'];
            } else {
                $_SESSION['flash'] = ['pesan' => 'Gagal memperbarui pengaturan', 'tipe' => 'danger'];
            }
        }

        $this->redirect('pengaturan');
    }

    public function tambah_konsentrasi() {
        if ($this->model('Pengaturan_model')->tambahKonsentrasi($_POST['nama_konsentrasi'])) {
            $_SESSION['flash'] = ['pesan' => 'Konsentrasi keahlian berhasil ditambah', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menambah data', 'tipe' => 'danger'];
        }
        $this->redirect('pengaturan');
    }

    public function hapus_konsentrasi($id) {
        if ($this->model('Pengaturan_model')->hapusKonsentrasi($id)) {
            $_SESSION['flash'] = ['pesan' => 'Konsentrasi keahlian berhasil dihapus', 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menghapus data', 'tipe' => 'danger'];
        }
        $this->redirect('pengaturan');
    }

    public function update_aplikasi() {
        // Hanya Admin yang boleh melakukan update
        if ($_SESSION['peran'] !== 'Admin') {
            $_SESSION['flash'] = ['pesan' => 'Hanya Admin yang dapat memperbarui aplikasi', 'tipe' => 'danger'];
            $this->redirect('pengaturan');
        }

        // Perintah git pull
        // Pastikan server memiliki git terinstal dan izin folder yang tepat
        $output = shell_exec('git pull ' . GIT_URL . ' master 2>&1');

        if ($output) {
            $_SESSION['flash'] = [
                'pesan' => 'Log Update: ' . $output,
                'tipe' => strpos($output, 'Updating') !== false || strpos($output, 'Already up to date') !== false ? 'success' : 'danger'
            ];
        } else {
            $_SESSION['flash'] = ['pesan' => 'Gagal menjalankan perintah update. Pastikan Git terinstal di server.', 'tipe' => 'danger'];
        }

        $this->redirect('pengaturan');
    }
}
