<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Data Siswa</h1>
        <p class="text-slate-600">Kelola daftar peserta didik.</p>
    </div>
    <button onclick="document.getElementById('modal-siswa').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-1"></i> Tambah Siswa
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
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">NIS / NISN</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Siswa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Thn Masuk</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-slate-200">
            <?php foreach($data['siswa'] as $s) : ?>
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= $s['nis']; ?> / <?= $s['nisn']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= $s['nama_siswa']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= $s['tahun_masuk']; ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="<?= BASEURL; ?>/siswa/edit/<?= $s['id']; ?>" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <a href="<?= BASEURL; ?>/siswa/hapus/<?= $s['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus siswa ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="modal-siswa" class="fixed inset-0 bg-slate-900 bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">Tambah Siswa</h3>
            <button onclick="document.getElementById('modal-siswa').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="<?= BASEURL; ?>/siswa/tambah" method="POST">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">NIS</label>
                    <input type="text" name="nis" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">NISN</label>
                    <input type="text" name="nisn" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Siswa</label>
                    <input type="text" name="nama_siswa" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Masuk</label>
                    <input type="number" name="tahun_masuk" value="<?= date('Y'); ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="document.getElementById('modal-siswa').classList.add('hidden')" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-md">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
