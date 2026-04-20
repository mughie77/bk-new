<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Mapping Siswa ke Kelas</h1>
    <p class="text-slate-600">Pilih kelas untuk mengelola daftar siswanya.</p>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 mb-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-100' : 'text-red-700 bg-red-100' ?> rounded-lg" role="alert">
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Sidebar Kelas -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200 h-fit">
        <h3 class="font-semibold text-slate-800 mb-3 border-b pb-2">Daftar Kelas</h3>
        <div class="space-y-1">
            <?php foreach($data['kelas'] as $k) : ?>
                <a href="<?= BASEURL; ?>/mapping/siswa/<?= $k['id']; ?>" class="block px-3 py-2 rounded-md text-sm <?= $data['selected_kelas'] == $k['id'] ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-100' ?>">
                    <?= $k['nama_kelas']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Konten Mapping -->
    <div class="md:col-span-3 space-y-6">
        <?php if($data['selected_kelas']) : ?>
            <!-- Form Tambah -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
                <h3 class="font-semibold text-slate-800 mb-4">Tambah Siswa ke Kelas</h3>
                <form action="<?= BASEURL; ?>/mapping/tambah_siswa" method="POST" class="flex gap-4">
                    <input type="hidden" name="kelas_id" value="<?= $data['selected_kelas']; ?>">
                    <select name="siswa_id" required class="flex-1 px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Siswa --</option>
                        <?php foreach($data['siswa_tersedia'] as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nis']; ?> - <?= $s['nama_siswa']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="nomor_urut" placeholder="No Urut" class="w-20 px-3 py-2 border border-slate-300 rounded-md">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">Tambah</button>
                </form>
            </div>

            <!-- List Siswa -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                <table class="min-w-full divide-y divide-slate-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase w-16">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama Siswa</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        <?php if(empty($data['siswa_di_kelas'])) : ?>
                            <tr><td colspan="4" class="px-6 py-4 text-center text-slate-400">Belum ada siswa di kelas ini.</td></tr>
                        <?php endif; ?>
                        <?php foreach($data['siswa_di_kelas'] as $s) : ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-mono"><?= $s['nomor_urut']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500"><?= $s['nis']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900"><?= $s['nama_siswa']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="<?= BASEURL; ?>/mapping/hapus_siswa/<?= $s['mapping_id']; ?>/<?= $data['selected_kelas']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Keluarkan siswa dari kelas?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="bg-blue-50 p-8 rounded-lg border border-blue-100 text-center text-blue-600">
                <i class="fas fa-arrow-left text-4xl mb-4 block"></i>
                Silakan pilih kelas terlebih dahulu dari daftar di samping.
            </div>
        <?php endif; ?>
    </div>
</div>
