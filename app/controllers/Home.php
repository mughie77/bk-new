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

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
