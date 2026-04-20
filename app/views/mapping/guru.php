<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Mapping Kelas ke Guru BK</h1>
    <p class="text-slate-600">Tugaskan Guru BK ke kelas-kelas tertentu.</p>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 mb-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-100' : 'text-red-700 bg-red-100' ?> rounded-lg" role="alert">
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Form Mapping -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200 h-fit">
        <h2 class="text-lg font-semibold text-slate-800 mb-4 border-b pb-2">Buat Penugasan</h2>
        <form action="<?= BASEURL; ?>/mapping/tambah_guru" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700">Pilih Guru BK</label>
                <select name="guru_id" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Guru --</option>
                    <?php foreach($data['guru'] as $g) : ?>
                        <option value="<?= $g['id']; ?>"><?= $g['nama_guru']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Pilih Kelas</label>
                <select name="kelas_id" required class="mt-1 block w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Kelas --</option>
                    <?php foreach($data['kelas'] as $k) : ?>
                        <option value="<?= $k['id']; ?>"><?= $k['nama_kelas']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">Simpan Penugasan</button>
        </form>
    </div>

    <!-- Daftar Mapping -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden h-fit">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama Guru</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                <?php foreach($data['mapping'] as $m) : ?>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= $m['nama_guru']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= $m['nama_kelas']; ?></td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="<?= BASEURL; ?>/mapping/hapus_guru/<?= $m['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus penugasan ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
