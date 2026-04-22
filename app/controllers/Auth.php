<?php

class Auth extends Controller {
    public function index() {
        if (isset($_SESSION['login'])) {
            $this->redirect('home');
        }
        $data['judul'] = 'Login - Aplikasi BK';
        $data['sekolah'] = $this->model('Pengaturan_model')->getPengaturan();
        $this->view('auth/login', $data);
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model('Pengguna_model')->getUserByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nama'] = $user['nama_lengkap'];
                $_SESSION['peran'] = $user['peran'];

                $this->redirect('home');
            } else {
                $_SESSION['flash'] = [
                    'pesan' => 'Password salah',
                    'tipe' => 'danger'
                ];
                $this->redirect('auth');
            }
        } else {
            $_SESSION['flash'] = [
                'pesan' => 'Username tidak ditemukan',
                'tipe' => 'danger'
            ];
            $this->redirect('auth');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirect('auth');
    }
}
