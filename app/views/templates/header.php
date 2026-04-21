<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }

        /* Custom scrollbar for better look */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .active-menu {
            background-color: #eff6ff;
            color: #1d4ed8;
            border-right: 4px solid #1d4ed8;
        }
    </style>
</head>
<body class="bg-slate-50 flex flex-col h-screen overflow-hidden">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm border-b border-slate-200 h-16 flex-shrink-0 z-50">
        <div class="max-w-full mx-auto px-4 h-full flex justify-between items-center">
            <div class="flex items-center">
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg mr-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <span class="text-xl font-bold text-blue-700">Aplikasi BK</span>
            </div>
            <div class="flex items-center space-x-4">
                <div class="hidden sm:block text-right">
                    <p class="text-xs font-semibold text-slate-800 leading-none"><?= $_SESSION['nama']; ?></p>
                    <p class="text-[10px] text-slate-500 uppercase"><?= $_SESSION['peran']; ?></p>
                </div>
                <a href="<?= BASEURL; ?>/auth/logout" class="bg-red-50 text-red-600 p-2 rounded-full hover:bg-red-100 transition sm:px-4 sm:py-2 sm:rounded-md sm:text-xs sm:font-bold">
                    <i class="fas fa-sign-out-alt sm:mr-1"></i> <span class="hidden sm:inline">Logout</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden relative">
        <!-- Overlay for Mobile Sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden md:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-40 w-64 bg-white border-r border-slate-200 flex flex-col flex-shrink-0">
            <div class="flex-1 overflow-y-auto py-4">
                <div class="px-4 mb-4 md:hidden">
                    <p class="text-lg font-bold text-blue-700">Menu Utama</p>
                </div>

                <?php
                    $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : ['home'];
                    $controller = $url[0];
                    $method = isset($url[1]) ? $url[1] : '';

                    function isActive($target_controller, $target_method, $current_controller, $current_method) {
                        if ($target_controller == $current_controller) {
                            if ($target_method == '' || $target_method == $current_method) {
                                return 'active-menu';
                            }
                        }
                        return 'text-slate-700 hover:bg-blue-50 hover:text-blue-700';
                    }
                ?>

                <nav class="space-y-1">
                    <a href="<?= BASEURL; ?>/home" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('home', '', $controller, $method); ?>">
                        <i class="fas fa-home w-6"></i> <span>Dashboard</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Data Master</div>
                    <a href="<?= BASEURL; ?>/guru" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('guru', '', $controller, $method); ?>">
                        <i class="fas fa-chalkboard-teacher w-6"></i> <span>Guru BK</span>
                    </a>
                    <a href="<?= BASEURL; ?>/siswa" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('siswa', '', $controller, $method); ?>">
                        <i class="fas fa-user-graduate w-6"></i> <span>Siswa</span>
                    </a>
                    <a href="<?= BASEURL; ?>/kelas" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('kelas', '', $controller, $method); ?>">
                        <i class="fas fa-school w-6"></i> <span>Kelas</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Mapping</div>
                    <a href="<?= BASEURL; ?>/mapping/siswa" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('mapping', 'siswa', $controller, $method); ?>">
                        <i class="fas fa-users-cog w-6"></i> <span>Siswa ke Kelas</span>
                    </a>
                    <a href="<?= BASEURL; ?>/mapping/guru" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('mapping', 'guru', $controller, $method); ?>">
                        <i class="fas fa-user-tag w-6"></i> <span>Kelas ke Guru</span>
                    </a>

                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Layanan</div>
                    <a href="<?= BASEURL; ?>/konsultasi" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('konsultasi', '', $controller, $method); ?>">
                        <i class="fas fa-comments w-6"></i> <span>Laporan Konsultasi</span>
                    </a>
                    <a href="<?= BASEURL; ?>/sosiogram" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('sosiogram', '', $controller, $method); ?>">
                        <i class="fas fa-project-diagram w-6"></i> <span>Sosiogram</span>
                    </a>

                    <?php if($_SESSION['peran'] == 'Admin'): ?>
                    <div class="pt-4 pb-1 px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem</div>
                    <a href="<?= BASEURL; ?>/pengaturan" class="flex items-center px-4 py-3 text-sm font-medium transition <?= isActive('pengaturan', '', $controller, $method); ?>">
                        <i class="fas fa-cogs w-6"></i> <span>Pengaturan</span>
                    </a>
                    <?php endif; ?>
                </nav>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <div class="flex-1 overflow-y-auto p-4 md:p-8">
