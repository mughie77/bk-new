<!-- Header Welcome Section -->
<div class="relative overflow-hidden bg-gradient-to-r from-blue-700 to-indigo-800 rounded-[2rem] p-8 md:p-12 text-white shadow-2xl shadow-blue-200">
    <div class="relative z-10 max-w-2xl">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-4 tracking-tight">Selamat Datang Kembali, <br><span class="text-blue-200"><?= $data['user']; ?>!</span></h1>
        <p class="text-blue-100/80 text-lg font-light leading-relaxed mb-8">Kelola bimbingan konseling dengan lebih cerdas, efisien, dan terarah untuk mendukung potensi terbaik setiap siswa.</p>
        <div class="flex flex-wrap gap-3">
            <a href="<?= BASEURL; ?>/konsultasi" class="bg-white text-blue-700 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-blue-50 transition shadow-lg">Mulai Laporan Baru</a>
            <a href="<?= BASEURL; ?>/sosiogram" class="bg-blue-600/50 backdrop-blur-md text-white border border-white/20 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-blue-600/70 transition">Analisis Sosiogram</a>
        </div>
    </div>

    <!-- Abstract Decoration -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 p-12 opacity-10 hidden lg:block">
        <i class="fas fa-user-shield text-[12rem]"></i>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 group">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-users-viewfinder text-xl"></i>
            </div>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-full">Total Siswa</span>
        </div>
        <div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tight">1,248</h3>
            <p class="text-sm text-slate-500 mt-1">Siswa Terdaftar</p>
        </div>
        <div class="mt-6 pt-6 border-t border-slate-50 flex items-center text-xs text-emerald-500 font-bold">
            <i class="fas fa-arrow-up mr-1"></i> 12 Siswa baru minggu ini
        </div>
    </div>

    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-emerald-500/5 transition-all duration-300 group">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-calendar-check text-xl"></i>
            </div>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-full">Konsultasi</span>
        </div>
        <div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tight">42</h3>
            <p class="text-sm text-slate-500 mt-1">Sesi Bulan Ini</p>
        </div>
        <div class="mt-6 pt-6 border-t border-slate-50 flex items-center text-xs text-blue-500 font-bold">
            <i class="fas fa-clock mr-1"></i> Rata-rata 45 menit/sesi
        </div>
    </div>

    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-amber-500/5 transition-all duration-300 group">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors duration-300">
                <i class="fas fa-diagram-project text-xl"></i>
            </div>
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-full">Sosiogram</span>
        </div>
        <div>
            <h3 class="text-3xl font-black text-slate-800 tracking-tight">18</h3>
            <p class="text-sm text-slate-500 mt-1">Kelas Teranalisis</p>
        </div>
        <div class="mt-6 pt-6 border-t border-slate-50 flex items-center text-xs text-amber-600 font-bold">
            <i class="fas fa-bolt mr-1"></i> Data real-time sinkron
        </div>
    </div>
</div>

<!-- Bottom Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
        <div class="flex justify-between items-center mb-8">
            <h3 class="font-bold text-slate-800 flex items-center">
                <span class="w-2 h-8 bg-blue-600 rounded-full mr-3"></span>
                Aktivitas Terbaru
            </h3>
            <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="space-y-6">
            <?php for($i=0; $i<3; $i++): ?>
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 border border-slate-100">
                    <i class="fas fa-user-edit text-xs"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800">Konsultasi Baru: Siswa Anonim</p>
                    <p class="text-xs text-slate-500 mt-1">2 jam yang lalu • Topik: Penyesuaian Akademik</p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
        <div class="flex justify-between items-center mb-8">
            <h3 class="font-bold text-slate-800 flex items-center">
                <span class="w-2 h-8 bg-emerald-500 rounded-full mr-3"></span>
                Status Pemeliharaan
            </h3>
        </div>
        <div class="bg-slate-50 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-medium text-slate-600">Update Database</span>
                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold rounded-full uppercase">Terbaru</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-slate-600">Update Aplikasi</span>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold rounded-full uppercase tracking-tighter">Versi 2.0.4</span>
            </div>
            <a href="<?= BASEURL; ?>/pengaturan" class="mt-6 w-full flex items-center justify-center space-x-2 bg-white border border-slate-200 py-3 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50 transition">
                <i class="fas fa-gear text-slate-400"></i>
                <span>Buka Pengaturan Sistem</span>
            </a>
        </div>
    </div>
</div>
