<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Pengaturan Sistem</h1>
    <p class="text-slate-600">Kelola identitas sekolah dan data referensi.</p>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 mb-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-100' : 'text-red-700 bg-red-100' ?> rounded-lg" role="alert">
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Form Pengaturan Sekolah -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800 mb-4 border-b pb-2 flex items-center">
            <i class="fas fa-school mr-2 text-blue-600"></i> Identitas Sekolah
        </h2>
        <form action="<?= BASEURL; ?>/pengaturan/update" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id" value="<?= $data['pengaturan']['id']; ?>">
            <div>
                <label class="block text-sm font-medium text-slate-700">Nama Sekolah</label>
                <input type="text" name="nama_sekolah" value="<?= $data['pengaturan']['nama_sekolah']; ?>" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Kop Surat (JPG/PNG)</label>
                <?php if($data['pengaturan']['kop_surat']): ?>
                    <img src="<?= BASEURL; ?>/uploads/<?= $data['pengaturan']['kop_surat']; ?>" alt="Kop Surat" class="h-20 mb-2 border rounded">
                <?php endif; ?>
                <input type="file" name="kop_surat" class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Semester</label>
                    <select name="semester" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="Ganjil" <?= $data['pengaturan']['semester'] == 'Ganjil' ? 'selected' : ''; ?>>Ganjil</option>
                        <option value="Genap" <?= $data['pengaturan']['semester'] == 'Genap' ? 'selected' : ''; ?>>Genap</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Tahun Pelajaran</label>
                    <input type="text" name="tahun_pelajaran" value="<?= $data['pengaturan']['tahun_pelajaran']; ?>" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nama Kepala Sekolah</label>
                    <input type="text" name="nama_kepala_sekolah" value="<?= $data['pengaturan']['nama_kepala_sekolah']; ?>" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">NIP Kepala Sekolah</label>
                    <input type="text" name="nip_kepala_sekolah" value="<?= $data['pengaturan']['nip_kepala_sekolah']; ?>" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>
            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">Simpan Perubahan</button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100">
            <h3 class="text-sm font-semibold text-slate-800 mb-2">Update Aplikasi</h3>
            <p class="text-xs text-slate-500 mb-4">Klik tombol di bawah untuk memperbarui aplikasi langsung dari repository GitHub.</p>
            <div class="bg-slate-50 p-3 rounded border border-slate-200 mb-4">
                <p class="text-[10px] font-mono text-slate-600 truncate"><?= GIT_URL; ?></p>
            </div>
            <a href="<?= BASEURL; ?>/pengaturan/update_aplikasi" onclick="return confirm('Apakah Anda yakin ingin memperbarui aplikasi? Pastikan koneksi internet stabil.')" class="inline-flex items-center justify-center w-full bg-slate-800 text-white py-2 px-4 rounded-md hover:bg-slate-900 transition text-sm">
                <i class="fab fa-github mr-2"></i> Update dari GitHub
            </a>
        </div>
    </div>

    <!-- CRUD Konsentrasi Keahlian -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800 mb-4 border-b pb-2 flex items-center">
            <i class="fas fa-graduation-cap mr-2 text-emerald-600"></i> Konsentrasi Keahlian
        </h2>

        <form action="<?= BASEURL; ?>/pengaturan/tambah_konsentrasi" method="POST" class="flex gap-2 mb-6">
            <input type="text" name="nama_konsentrasi" placeholder="Tambah Konsentrasi Baru..." required class="flex-1 px-3 py-2 bg-white border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
            <button type="submit" class="bg-emerald-600 text-white py-2 px-4 rounded-md hover:bg-emerald-700 transition">Tambah</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Konsentrasi</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    <?php foreach($data['konsentrasi'] as $k) : ?>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-slate-700"><?= $k['nama_konsentrasi']; ?></td>
                        <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                            <a href="<?= BASEURL; ?>/pengaturan/hapus_konsentrasi/<?= $k['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus konsentrasi ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
