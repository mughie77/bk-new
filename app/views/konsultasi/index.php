<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Laporan Konsultasi</h1>
        <p class="text-slate-600">Daftar riwayat bimbingan dan konseling siswa.</p>
    </div>
    <button onclick="document.getElementById('modal-konsultasi').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-1"></i> Input Konsultasi
    </button>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 mb-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-100' : 'text-red-700 bg-red-100' ?> rounded-lg" role="alert">
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Tanggal</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama Siswa (Samaran)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama Asli</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Topik</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            <?php foreach($data['konsultasi'] as $k) : ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= date('d/m/Y', strtotime($k['tanggal'])); ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                    <?php if($k['is_anonim']): ?>
                        <span class="bg-amber-50 text-amber-700 px-2 py-1 rounded text-xs border border-amber-200 font-mono">SAMARAN</span>
                    <?php else: ?>
                        <span class="text-slate-400">-</span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700"><?= $k['nama_siswa']; ?></td>
                <td class="px-6 py-4 text-sm text-slate-500 truncate max-w-xs"><?= $k['topik']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="<?= BASEURL; ?>/konsultasi/cetak/<?= $k['id']; ?>" target="_blank" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-print"></i> Cetak</a>
                    <a href="<?= BASEURL; ?>/konsultasi/hapus/<?= $k['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus laporan ini?')"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
        <div class="text-xs text-slate-500">
            Halaman <?= $data['halaman_aktif']; ?> dari <?= $data['total_halaman']; ?>
        </div>
        <div class="flex space-x-2">
            <?php if($data['halaman_aktif'] > 1) : ?>
                <a href="<?= BASEURL; ?>/konsultasi/index/<?= $data['halaman_aktif'] - 1; ?>" class="px-3 py-1 bg-white border border-slate-300 rounded text-xs hover:bg-slate-50">Prev</a>
            <?php endif; ?>

            <?php if($data['halaman_aktif'] < $data['total_halaman']) : ?>
                <a href="<?= BASEURL; ?>/konsultasi/index/<?= $data['halaman_aktif'] + 1; ?>" class="px-3 py-1 bg-white border border-slate-300 rounded text-xs hover:bg-slate-50">Next</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal-konsultasi" class="fixed inset-0 bg-slate-900 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-2xl p-6 overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h3 class="text-lg font-bold">Form Input Konsultasi</h3>
            <button onclick="document.getElementById('modal-konsultasi').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="<?= BASEURL; ?>/konsultasi/tambah" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Siswa</label>
                    <select name="siswa_id" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Siswa --</option>
                        <?php foreach($data['siswa'] as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nis']; ?> - <?= $s['nama_siswa']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="mt-2 flex items-center">
                        <input type="checkbox" name="is_anonim" id="is_anonim" class="h-4 w-4 text-blue-600 border-slate-300 rounded">
                        <label for="is_anonim" class="ml-2 block text-xs text-slate-600 italic">Samarkan Nama Peserta Didik dengan Kode (Anonim)</label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Waktu (Menit)</label>
                    <input type="number" name="waktu_menit" required placeholder="30" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Konsultan / Narasumber</label>
                    <input type="text" name="konsultan" value="<?= $_SESSION['nama']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Peran Konselor</label>
                    <input type="text" name="peran_konselor" placeholder="Misal: Guru BK" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Topik Pembahasan</label>
                    <textarea name="topik" rows="4" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan secara ringkas topik konsultasi..."></textarea>
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6 border-t pt-4">
                <button type="button" onclick="document.getElementById('modal-konsultasi').classList.add('hidden')" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-md">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan Laporan</button>
            </div>
        </form>
    </div>
</div>
