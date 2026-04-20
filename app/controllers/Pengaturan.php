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
        $file_name = null;

        if ($file['name']) {
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            if (!in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                $_SESSION['flash'] = ['pesan' => 'Ekstensi file kop surat tidak valid (Hanya .jpg, .png)', 'tipe' => 'danger'];
                $upload_ok = false;
            } else {
                // Gunakan path absolut BASEPATH untuk upload
                $upload_dir = BASEPATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads';

                // Buat folder jika belum ada
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }

                // Beri nama unik agar tidak cache dan tidak bentrok
                $file_name = 'kop_' . time() . '.' . $ext;
                $target_path = $upload_dir . DIRECTORY_SEPARATOR . $file_name;

                if (!move_uploaded_file($file['tmp_name'], $target_path)) {
                    $_SESSION['flash'] = ['pesan' => 'Gagal mengupload file ke server.', 'tipe' => 'danger'];
                    $upload_ok = false;
                } else {
                    // Update data dengan nama file baru
                    $file['name'] = $file_name;
                }
            }
        }

        if ($upload_ok) {
            if ($this->model('Pengaturan_model')->updatePengaturan($_POST, $file['name'] ? $file : null)) {
                $_SESSION['flash'] = ['pesan' => 'Pengaturan berhasil diperbarui', 'tipe' => 'success'];
            } else {
                $_SESSION['flash'] = ['pesan' => 'Gagal memperbarui database pengaturan', 'tipe' => 'danger'];
            }
        }

        $this->redirect('pengaturan');
    }

    public function tambah_konsentrasi() {
        if ($this->model('Pengaturan_model')->tambahKonsentrasi($_POST)) {
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
        if ($_SESSION['peran'] !== 'Admin') {
            $_SESSION['flash'] = ['pesan' => 'Hanya Admin yang dapat memperbarui aplikasi', 'tipe' => 'danger'];
            $this->redirect('pengaturan');
        }

        $base = BASEPATH;

        // Cek apakah Git terinstal
        $git_check = shell_exec("git --version");
        if (!$git_check) {
            $_SESSION['cli_output'] = [
                'command' => 'git --version',
                'output' => 'Git tidak ditemukan di server. Pastikan Git sudah terinstal dan masuk ke Environment Path.',
                'status' => 'error'
            ];
            $this->redirect('pengaturan');
        }

        // Jalankan serangkaian perintah
        $commands = [];
        $commands[] = "git config --global --add safe.directory \"$base\"";

        if (!is_dir($base . DIRECTORY_SEPARATOR . '.git')) {
            $commands[] = "cd /d \"$base\" && git init";
            $commands[] = "cd /d \"$base\" && git remote add origin " . GIT_URL;
        } else {
            $commands[] = "cd /d \"$base\" && git remote set-url origin " . GIT_URL;
        }

        $commands[] = "cd /d \"$base\" && git fetch --all";
        $commands[] = "cd /d \"$base\" && git remote set-head origin -a";
        $commands[] = "cd /d \"$base\" && git reset --hard origin/HEAD";

        $full_output = "";
        $is_success = true;

        foreach ($commands as $cmd) {
            $cmd_output = [];
            exec($cmd . " 2>&1", $cmd_output, $result_code);
            $full_output .= "> " . $cmd . "\n" . implode("\n", $cmd_output) . "\n\n";

            if ($result_code !== 0) {
                if (strpos($cmd, 'safe.directory') === false && strpos($cmd, 'set-head') === false) {
                    $is_success = false;
                }
            }
        }

        $_SESSION['cli_output'] = [
            'command' => "Git Intelligent Update",
            'output' => $full_output,
            'status' => $is_success ? 'success' : 'error'
        ];

        $this->redirect('pengaturan');
    }

    public function update_database() {
        if ($_SESSION['peran'] !== 'Admin') {
            $_SESSION['flash'] = ['pesan' => 'Hanya Admin yang dapat memperbarui database', 'tipe' => 'danger'];
            $this->redirect('pengaturan');
        }

        $result = $this->model('Pengaturan_model')->updateDb();

        if ($result['success']) {
            $_SESSION['flash'] = ['pesan' => $result['message'], 'tipe' => 'success'];
        } else {
            $_SESSION['flash'] = ['pesan' => $result['message'], 'tipe' => 'danger'];
        }
        $this->redirect('pengaturan');
    }
}
