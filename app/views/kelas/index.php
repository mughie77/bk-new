<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-black text-slate-800 tracking-tight">Rombongan Belajar</h1>
        <p class="text-sm text-slate-500">Daftar kelas dan konsentrasi keahlian.</p>
    </div>
    <button onclick="document.getElementById('modal-kelas').classList.remove('hidden')" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition shadow-lg shadow-blue-200 flex items-center justify-center">
        <i class="fas fa-plus-circle mr-2"></i> Tambah Kelas
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
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Identitas Kelas</th>
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Konsentrasi Keahlian</th>
                    <th class="px-8 py-5 text-right text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if(empty($data['kelas'])) : ?>
                    <tr><td colspan="3" class="px-8 py-10 text-center text-slate-400 italic">Belum ada data kelas.</td></tr>
                <?php endif; ?>
                <?php foreach($data['kelas'] as $k) : ?>
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-black text-xs mr-4 border border-slate-200">
                                <?= strtoupper(substr($k['nama_kelas'], 0, 2)); ?>
                            </div>
                            <span class="text-sm font-bold text-slate-800 group-hover:text-blue-700 transition-colors uppercase"><?= $k['nama_kelas']; ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full border border-emerald-100"><?= $k['nama_konsentrasi'] ?? 'N/A'; ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="<?= BASEURL; ?>/kelas/edit/<?= $k['id']; ?>" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <i class="fas fa-pen text-xs"></i>
                            </a>
                            <a href="<?= BASEURL; ?>/kelas/hapus/<?= $k['id']; ?>" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm" onclick="return confirm('Hapus kelas ini?')">
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
                <a href="<?= BASEURL; ?>/kelas/index/<?= $data['halaman_aktif'] - 1; ?>" class="h-9 px-4 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 flex items-center hover:bg-slate-50 transition shadow-sm">
                    <i class="fas fa-chevron-left mr-2"></i> Previous
                </a>
            <?php endif; ?>

            <?php if($data['halaman_aktif'] < $data['total_halaman']) : ?>
                <a href="<?= BASEURL; ?>/kelas/index/<?= $data['halaman_aktif'] + 1; ?>" class="h-9 px-4 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 flex items-center hover:bg-slate-50 transition shadow-sm">
                    Next <i class="fas fa-chevron-right ml-2"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Kelas -->
<div id="modal-kelas" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-[60] p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-lg p-8 md:p-10 shadow-2xl scale-in transition-transform">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="text-2xl font-black text-slate-800">Tambah Kelas</h3>
                <p class="text-sm text-slate-500">Buat rombongan belajar baru.</p>
            </div>
            <button onclick="document.getElementById('modal-kelas').classList.add('hidden')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="<?= BASEURL; ?>/kelas/tambah" method="POST" class="space-y-6">
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-wider">Nama Kelas</label>
                <input type="text" name="nama_kelas" required placeholder="XII RPL 1" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm font-bold uppercase">
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-700 ml-1 uppercase tracking-wider">Pilih Konsentrasi Keahlian</label>
                <select name="konsentrasi_id" required class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm appearance-none cursor-pointer">
                    <option value="">-- Pilih Jurusan --</option>
                    <?php foreach($data['konsentrasi'] as $kk) : ?>
                        <option value="<?= $kk['id']; ?>"><?= $kk['nama_konsentrasi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex gap-3 pt-6">
                <button type="button" onclick="document.getElementById('modal-kelas').classList.add('hidden')" class="flex-1 px-6 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold text-sm hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="flex-[2] px-6 py-4 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-200">Simpan Kelas</button>
            </div>
        </form>
    </div>
</div>
