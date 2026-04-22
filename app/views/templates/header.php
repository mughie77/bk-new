<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }

        .active-menu {
            background: linear-gradient(to right, #eff6ff, #ffffff);
            color: #2563eb;
            border-right: 4px solid #2563eb;
            font-weight: 600;
        }
        .active-menu i { color: #2563eb; }
    </style>
</head>
<body class="bg-slate-50 flex flex-col h-screen overflow-hidden text-slate-900">
    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-slate-200 h-16 flex-shrink-0 z-50 px-4 md:px-8">
        <div class="max-w-full mx-auto h-full flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button id="mobile-menu-btn" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-xl transition">
                    <i class="fas fa-bars-staggered text-xl"></i>
                </button>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-200">
                        <i class="fas fa-heart-pulse text-sm"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-800 hidden sm:block">BK<span class="text-blue-600">Smart</span></span>
                </div>
            </div>

            <div class="flex items-center space-x-3 md:space-x-6">
                <div class="hidden md:flex flex-col items-end">
                    <span class="text-sm font-bold text-slate-800 leading-none"><?= $_SESSION['nama']; ?></span>
                    <span class="text-[10px] font-medium text-slate-400 uppercase tracking-widest mt-1"><?= $_SESSION['peran']; ?></span>
                </div>
                <div class="h-10 w-10 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500 overflow-hidden">
                    <i class="fas fa-user-circle text-2xl"></i>
                </div>
                <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>
                <a href="<?= BASEURL; ?>/auth/logout" class="text-slate-400 hover:text-red-500 transition-colors p-2">
                    <i class="fas fa-power-off text-lg"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden relative">
        <!-- Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-all duration-300 ease-in-out z-40 w-72 bg-white border-r border-slate-200 flex flex-col flex-shrink-0 shadow-xl md:shadow-none">
            <div class="flex-1 overflow-y-auto py-6 px-4 custom-scrollbar">
                <?php
                    $url = isset($_GET['url']) ? explode('/', rtrim($_GET['url'], '/')) : ['home'];
                    $controller = strtolower($url[0]);
                    $method = isset($url[1]) ? strtolower($url[1]) : '';

                    function isActive($target_controller, $target_method, $curr_c, $curr_m) {
                        if ($target_controller == $curr_c) {
                            if ($target_method == '' || $target_method == $curr_m) return 'active-menu';
                        }
                        return 'text-slate-500 hover:bg-slate-50 hover:text-slate-900';
                    }
                ?>

                <div class="space-y-1">
                    <a href="<?= BASEURL; ?>/home" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('home', '', $controller, $method); ?>">
                        <i class="fas fa-columns w-5 text-lg"></i>
                        <span class="text-sm font-medium">Overview</span>
                    </a>

                    <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Management</div>
                    <a href="<?= BASEURL; ?>/guru" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('guru', '', $controller, $method); ?>">
                        <i class="fas fa-user-tie w-5 text-lg"></i>
                        <span class="text-sm font-medium">Guru Pembimbing</span>
                    </a>
                    <a href="<?= BASEURL; ?>/siswa" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('siswa', '', $controller, $method); ?>">
                        <i class="fas fa-user-graduate w-5 text-lg"></i>
                        <span class="text-sm font-medium">Data Siswa</span>
                    </a>
                    <a href="<?= BASEURL; ?>/kelas" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('kelas', '', $controller, $method); ?>">
                        <i class="fas fa-layer-group w-5 text-lg"></i>
                        <span class="text-sm font-medium">Rombongan Belajar</span>
                    </a>

                    <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Relational</div>
                    <a href="<?= BASEURL; ?>/mapping/siswa" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('mapping', 'siswa', $controller, $method); ?>">
                        <i class="fas fa-users-viewfinder w-5 text-lg"></i>
                        <span class="text-sm font-medium">Plotting Siswa</span>
                    </a>
                    <a href="<?= BASEURL; ?>/mapping/guru" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('mapping', 'guru', $controller, $method); ?>">
                        <i class="fas fa-id-badge w-5 text-lg"></i>
                        <span class="text-sm font-medium">Penugasan Kelas</span>
                    </a>

                    <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">Services</div>
                    <a href="<?= BASEURL; ?>/konsultasi" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('konsultasi', '', $controller, $method); ?>">
                        <i class="fas fa-clipboard-list w-5 text-lg"></i>
                        <span class="text-sm font-medium">Log Konsultasi</span>
                    </a>
                    <a href="<?= BASEURL; ?>/sosiogram" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('sosiogram', '', $controller, $method); ?>">
                        <i class="fas fa-diagram-project w-5 text-lg"></i>
                        <span class="text-sm font-medium">Analisis Sosiogram</span>
                    </a>

                    <?php if($_SESSION['peran'] == 'Admin'): ?>
                    <div class="pt-6 pb-2 px-4 text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">System</div>
                    <a href="<?= BASEURL; ?>/pengaturan" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200 <?= isActive('pengaturan', '', $controller, $method); ?>">
                        <i class="fas fa-sliders w-5 text-lg"></i>
                        <span class="text-sm font-medium">Konfigurasi</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-slate-100">
                <div class="bg-slate-50 rounded-2xl p-4">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">System Status</span>
                    </div>
                    <p class="text-[10px] text-slate-400 font-medium leading-relaxed">Versi 2.0 • Build Stable <br> SMK Negeri Unggul</p>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
            <div class="flex-1 overflow-y-auto p-4 md:p-10 scroll-smooth">
                <div class="max-w-7xl mx-auto space-y-8">
