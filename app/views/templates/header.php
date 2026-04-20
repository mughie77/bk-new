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
        body { font-family: 'Poppins', sans-serif; background-color: #f8fafc; }
    </style>
</head>
<body class="bg-slate-50">
    <nav class="bg-white shadow-md border-b border-slate-200 fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-blue-700">Aplikasi BK</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-slate-600">Halo, <?= $_SESSION['nama']; ?> (<?= $_SESSION['peran']; ?>)</span>
                    <a href="<?= BASEURL; ?>/auth/logout" class="bg-red-50 text-red-600 px-3 py-1 rounded-md text-sm font-medium hover:bg-red-100 transition">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex pt-16 min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-slate-200 hidden md:block">
            <div class="p-4 space-y-2">
                <a href="<?= BASEURL; ?>/home" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-home w-6"></i> <span>Dashboard</span>
                </a>
                <div class="pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase">Data Master</div>
                <a href="<?= BASEURL; ?>/guru" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-chalkboard-teacher w-6"></i> <span>Guru BK</span>
                </a>
                <a href="<?= BASEURL; ?>/siswa" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-user-graduate w-6"></i> <span>Siswa</span>
                </a>
                <a href="<?= BASEURL; ?>/kelas" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-school w-6"></i> <span>Kelas</span>
                </a>

                <div class="pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase">Mapping</div>
                <a href="<?= BASEURL; ?>/mapping/siswa" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-link w-6"></i> <span>Siswa ke Kelas</span>
                </a>
                <a href="<?= BASEURL; ?>/mapping/guru" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-user-tag w-6"></i> <span>Kelas ke Guru</span>
                </a>

                <div class="pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase">Layanan</div>
                <a href="<?= BASEURL; ?>/konsultasi" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-comments w-6"></i> <span>Laporan Konsultasi</span>
                </a>
                <a href="<?= BASEURL; ?>/sosiogram" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-project-diagram w-6"></i> <span>Sosiogram</span>
                </a>

                <div class="pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase">Sistem</div>
                <a href="<?= BASEURL; ?>/pengaturan" class="flex items-center p-2 text-slate-700 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">
                    <i class="fas fa-cogs w-6"></i> <span>Pengaturan</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
