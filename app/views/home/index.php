<div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
    <h1 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang, <?= $data['user']; ?>!</h1>
    <p class="text-slate-600">Ini adalah dashboard Aplikasi Bimbingan dan Konseling Sekolah. Silakan pilih menu di samping untuk mulai mengelola data.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
    <div class="bg-blue-600 p-6 rounded-lg shadow-md text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-blue-100 text-sm uppercase font-semibold">Total Siswa</p>
                <h3 class="text-3xl font-bold mt-1">0</h3>
            </div>
            <i class="fas fa-user-graduate text-4xl opacity-20"></i>
        </div>
    </div>
    <div class="bg-emerald-600 p-6 rounded-lg shadow-md text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-emerald-100 text-sm uppercase font-semibold">Konsultasi Hari Ini</p>
                <h3 class="text-3xl font-bold mt-1">0</h3>
            </div>
            <i class="fas fa-calendar-check text-4xl opacity-20"></i>
        </div>
    </div>
    <div class="bg-amber-600 p-6 rounded-lg shadow-md text-white">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-amber-100 text-sm uppercase font-semibold">Sosiogram Selesai</p>
                <h3 class="text-3xl font-bold mt-1">0</h3>
            </div>
            <i class="fas fa-chart-network text-4xl opacity-20"></i>
        </div>
    </div>
</div>
