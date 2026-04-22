<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-black text-slate-800 tracking-tight">Log Konsultasi</h1>
        <p class="text-sm text-slate-500">Riwayat bimbingan dan konseling siswa.</p>
    </div>
    <button onclick="document.getElementById('modal-konsultasi').classList.remove('hidden')" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition shadow-lg shadow-blue-200 flex items-center justify-center">
        <i class="fas fa-plus-circle mr-2"></i> Input Konsultasi
    </button>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-50 border-emerald-100' : 'text-red-700 bg-red-50 border-red-100' ?> rounded-2xl border flex items-center" role="alert">
        <i class="fas <?= $_SESSION['flash']['tipe'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?> mr-2"></i>
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto custom-scrollbar">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Waktu & Status</th>
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Identitas Peserta Didik</th>
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Topik Pembahasan</th>
                    <th class="px-8 py-5 text-right text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if(empty($data['konsultasi'])) : ?>
                    <tr><td colspan="4" class="px-8 py-10 text-center text-slate-400 italic">Belum ada riwayat konsultasi.</td></tr>
                <?php endif; ?>
                <?php foreach($data['konsultasi'] as $k) : ?>
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <span class="text-xs font-bold text-slate-800 block"><?= date('d M Y', strtotime($k['tanggal'])); ?></span>
                        <?php if($k['is_anonim']): ?>
                            <span class="mt-1 px-2 py-0.5 bg-amber-100 text-amber-700 text-[9px] font-black rounded uppercase border border-amber-200 inline-block">Samaran</span>
                        <?php else: ?>
                            <span class="mt-1 px-2 py-0.5 bg-blue-50 text-blue-600 text-[9px] font-black rounded uppercase border border-blue-100 inline-block">Reguler</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <span class="text-sm font-semibold text-slate-700 block"><?= $k['nama_siswa']; ?></span>
                        <span class="text-[10px] text-slate-400 uppercase font-medium tracking-tighter">NIS: <?= $k['nis']; ?> • <?= $k['nama_kelas']; ?></span>
                    </td>
                    <td class="px-8 py-5">
                        <p class="text-xs text-slate-500 line-clamp-1 max-w-[200px]" title="<?= $k['topik']; ?>"><?= $k['topik']; ?></p>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="<?= BASEURL; ?>/konsultasi/cetak/<?= $k['id']; ?>" target="_blank" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <i class="fas fa-print text-xs"></i>
                            </a>
                            <a href="<?= BASEURL; ?>/konsultasi/hapus/<?= $k['id']; ?>" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm" onclick="return confirm('Hapus laporan ini?')">
                                <i class="fas fa-trash text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
        <p class="text-xs font-medium text-slate-500">Page <span class="text-slate-800"><?= $data['halaman_aktif']; ?></span> of <?= $data['total_halaman']; ?></p>
        <div class="flex items-center space-x-2">
            <?php if($data['halaman_aktif'] > 1) : ?>
                <a href="<?= BASEURL; ?>/konsultasi/index/<?= $data['halaman_aktif'] - 1; ?>" class="h-9 px-4 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 flex items-center hover:bg-slate-50 transition shadow-sm">
                    <i class="fas fa-chevron-left mr-2"></i> Previous
                </a>
            <?php endif; ?>

            <?php if($data['halaman_aktif'] < $data['total_halaman']) : ?>
                <a href="<?= BASEURL; ?>/konsultasi/index/<?= $data['halaman_aktif'] + 1; ?>" class="h-9 px-4 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 flex items-center hover:bg-slate-50 transition shadow-sm">
                    Next <i class="fas fa-chevron-right ml-2"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Konsultasi -->
<div id="modal-konsultasi" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-[60] p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-2xl p-8 md:p-10 shadow-2xl scale-in transition-transform overflow-y-auto max-h-[90vh] custom-scrollbar">
        <div class="flex justify-between items-center mb-8 border-b border-slate-50 pb-6">
            <div>
                <h3 class="text-2xl font-black text-slate-800 tracking-tight">Form Konsultasi</h3>
                <p class="text-sm text-slate-500 font-medium">Input data bimbingan baru.</p>
            </div>
            <button onclick="document.getElementById('modal-konsultasi').classList.add('hidden')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="<?= BASEURL; ?>/konsultasi/tambah" method="POST" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2 space-y-3">
                    <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-widest">Pilih Siswa</label>
                    <select name="siswa_id" id="select-siswa" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm font-semibold appearance-none cursor-pointer">
                        <option value="">-- Pilih Peserta Didik --</option>
                        <?php foreach($data['siswa'] as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nis']; ?> - <?= $s['nama_siswa']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="flex items-center space-x-3 px-1">
                        <input type="checkbox" name="is_anonim" id="is_anonim" class="w-4 h-4 text-blue-600 bg-slate-50 border-slate-200 rounded focus:ring-blue-500">
                        <label for="is_anonim" class="text-[11px] text-slate-500 font-bold italic uppercase tracking-wider">Samarkan Identitas (Mode Anonim)</label>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-widest">Tanggal</label>
                    <input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-widest">Waktu (Menit)</label>
                    <input type="number" name="waktu_menit" required placeholder="30" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-widest">Konsultan</label>
                    <input type="text" name="konsultan" id="input-konsultan" value="Guru BK" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm font-bold">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-widest">Peran Konselor</label>
                    <input type="text" name="peran_konselor" value="Konsultan" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm font-bold">
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-widest">Topik Pembahasan</label>
                    <textarea name="topik" rows="4" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm font-medium leading-relaxed" placeholder="Jelaskan ringkasan konsultasi..."></textarea>
                </div>
            </div>
            <div class="flex gap-3 pt-8 border-t border-slate-50">
                <button type="button" onclick="document.getElementById('modal-konsultasi').classList.add('hidden')" class="flex-1 px-6 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold text-sm hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="flex-[2] px-6 py-4 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-200">Simpan Laporan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('select-siswa').addEventListener('change', function() {
        const siswaId = this.value;
        const inputKonsultan = document.getElementById('input-konsultan');
        if (siswaId) {
            fetch('<?= BASEURL; ?>/konsultasi/get_guru_by_siswa/' + siswaId)
                .then(response => response.json())
                .then(data => {
                    inputKonsultan.value = data.nama_guru ? data.nama_guru : 'Guru BK';
                });
        }
    });
</script>
