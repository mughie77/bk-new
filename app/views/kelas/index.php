<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Data Kelas</h1>
        <p class="text-slate-600">Kelola daftar kelas dan konsentrasi keahlian.</p>
    </div>
    <button onclick="document.getElementById('modal-kelas').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-1"></i> Tambah Kelas
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
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Kelas</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Konsentrasi Keahlian</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            <?php foreach($data['kelas'] as $k) : ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= $k['nama_kelas']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= $k['nama_konsentrasi'] ?? '-'; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="<?= BASEURL; ?>/kelas/edit/<?= $k['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <a href="<?= BASEURL; ?>/kelas/hapus/<?= $k['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus kelas ini?')">Hapus</a>
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
                <a href="<?= BASEURL; ?>/kelas/index/<?= $data['halaman_aktif'] - 1; ?>" class="px-3 py-1 bg-white border border-slate-300 rounded text-xs hover:bg-slate-50">Prev</a>
            <?php endif; ?>

            <?php if($data['halaman_aktif'] < $data['total_halaman']) : ?>
                <a href="<?= BASEURL; ?>/kelas/index/<?= $data['halaman_aktif'] + 1; ?>" class="px-3 py-1 bg-white border border-slate-300 rounded text-xs hover:bg-slate-50">Next</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal-kelas" class="fixed inset-0 bg-slate-900 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Tambah Kelas</h3>
            <button onclick="document.getElementById('modal-kelas').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="<?= BASEURL; ?>/kelas/tambah" method="POST">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kelas</label>
                    <input type="text" name="nama_kelas" required placeholder="Misal: XII RPL 1" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Konsentrasi Keahlian</label>
                    <select name="konsentrasi_id" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Konsentrasi --</option>
                        <?php foreach($data['konsentrasi'] as $kk) : ?>
                            <option value="<?= $kk['id']; ?>"><?= $kk['nama_konsentrasi']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="document.getElementById('modal-kelas').classList.add('hidden')" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-md">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
