<?php

if (!session_id()) session_start();

// Normalisasi path agar kompatibel dengan Windows (XAMPP) dan Linux
define('BASEPATH', str_replace(['/', '\\'], DIRECTORY_SEPARATOR, dirname(__DIR__)));

require_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'App.php';
require_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Controller.php';
require_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Database.php';
require_once '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';

$app = new App();
