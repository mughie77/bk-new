<?php

class Controller {
    public function view($view, $data = []) {
        // Global variables for all views
        if (!isset($data['sekolah'])) {
            $data['sekolah'] = $this->model('Pengaturan_model')->getPengaturan();
        }

        require_once '../app/views/' . $view . '.php';
    }

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }

    public function redirect($url) {
        header('Location: ' . BASEURL . '/' . $url);
        exit;
    }
}
