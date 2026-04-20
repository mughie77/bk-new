<?php

class Mapping extends Controller {
    public function __construct() {
        if (!isset($_SESSION['login'])) $this->redirect('auth');
    }

    public function siswa($kelas_id = null) {
        $data['judul'] = 'Mapping Siswa ke Kelas';
        $data['kelas'] = $this->model('Kelas_model')->getAllKelas();
        $data['selected_kelas'] = $kelas_id;
        $data['siswa_di_kelas'] = $kelas_id ? $this->model('Mapping_model')->getSiswaByKelas($kelas_id) : [];
        $data['siswa_tersedia'] = $this->model('Mapping_model')->getSiswaTanpaKelas();

        $this->view('templates/header', $data);
        $this->view('mapping/siswa', $data);
        $this->view('templates/footer');
    }

    public function tambah_siswa() {
        if ($this->model('Mapping_model')->tambahMappingSiswa($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Siswa berhasil dimasukkan dan nomor urut diatur ulang', 'tipe' => 'success'];
        }
        $this->redirect('mapping/siswa/' . $_POST['kelas_id']);
    }

    public function hapus_siswa($id, $kelas_id) {
        if ($this->model('Mapping_model')->hapusMappingSiswa($id, $kelas_id)) {
            $_SESSION['flash'] = ['pesan' => 'Siswa berhasil dikeluarkan dan nomor urut diatur ulang', 'tipe' => 'success'];
        }
        $this->redirect('mapping/siswa/' . $kelas_id);
    }

    public function guru() {
        $data['judul'] = 'Mapping Kelas ke Guru BK';
        $data['kelas'] = $this->model('Kelas_model')->getAllKelas();
        $data['guru'] = $this->model('Guru_model')->getAllGuru();
        $data['mapping'] = $this->model('Mapping_model')->getMappingGuru();

        $this->view('templates/header', $data);
        $this->view('mapping/guru', $data);
        $this->view('templates/footer');
    }

    public function tambah_guru() {
        if ($this->model('Mapping_model')->tambahMappingGuru($_POST)) {
            $_SESSION['flash'] = ['pesan' => 'Guru berhasil ditugaskan ke kelas', 'tipe' => 'success'];
        }
        $this->redirect('mapping/guru');
    }

    public function hapus_guru($id) {
        if ($this->model('Mapping_model')->hapusMappingGuru($id)) {
            $_SESSION['flash'] = ['pesan' => 'Tugas guru berhasil dihapus', 'tipe' => 'success'];
        }
        $this->redirect('mapping/guru');
    }
}
