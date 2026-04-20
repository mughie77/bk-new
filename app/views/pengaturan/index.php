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

<!-- Popup CLI Output -->
<?php if(isset($_SESSION['cli_output'])) : ?>
    <div id="cli-modal" class="fixed inset-0 bg-slate-900 bg-opacity-75 flex items-center justify-center z-[100] p-4">
        <div class="bg-slate-900 text-emerald-400 font-mono text-xs w-full max-w-3xl rounded-lg shadow-2xl border border-slate-700 overflow-hidden flex flex-col max-h-[80vh]">
            <div class="bg-slate-800 px-4 py-2 flex justify-between items-center border-b border-slate-700">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                    <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                    <span class="ml-2 text-slate-400">Terminal Output</span>
                </div>
                <button onclick="document.getElementById('cli-modal').remove()" class="text-slate-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4 overflow-y-auto whitespace-pre-wrap">
                <span class="text-slate-500"># Command: <?= $_SESSION['cli_output']['command']; ?></span>
                <div class="mt-2"><?= htmlspecialchars($_SESSION['cli_output']['output']); ?></div>
            </div>
            <div class="bg-slate-800 p-4 border-t border-slate-700 flex justify-end">
                <button onclick="document.getElementById('cli-modal').remove()" class="px-4 py-1 bg-slate-700 text-slate-200 rounded hover:bg-slate-600 transition">Tutup</button>
            </div>
        </div>
    </div>
    <?php unset($_SESSION['cli_output']); ?>
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

        <div class="mt-8 pt-6 border-t border-slate-100 space-y-6">
            <div>
                <h3 class="text-sm font-semibold text-slate-800 mb-2">Update Kode Aplikasi</h3>
                <a href="<?= BASEURL; ?>/pengaturan/update_aplikasi" class="inline-flex items-center justify-center w-full bg-slate-800 text-white py-2 px-4 rounded-md hover:bg-slate-900 transition text-sm">
                    <i class="fab fa-github mr-2"></i> Update dari GitHub
                </a>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-slate-800 mb-2">Update Database</h3>
                <a href="<?= BASEURL; ?>/pengaturan/update_database" class="inline-flex items-center justify-center w-full bg-emerald-800 text-white py-2 px-4 rounded-md hover:bg-emerald-900 transition text-sm">
                    <i class="fas fa-database mr-2"></i> Update Database
                </a>
            </div>
        </div>
    </div>

    <!-- CRUD Konsentrasi Keahlian -->
    <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
        <h2 class="text-lg font-semibold text-slate-800 mb-4 border-b pb-2 flex items-center">
            <i class="fas fa-graduation-cap mr-2 text-emerald-600"></i> Konsentrasi Keahlian
        </h2>

        <form action="<?= BASEURL; ?>/pengaturan/tambah_konsentrasi" method="POST" class="space-y-3 mb-6">
            <div class="grid grid-cols-3 gap-2">
                <input type="text" name="nama_konsentrasi" id="nama_kk" placeholder="Nama Konsentrasi..." required class="col-span-2 px-3 py-2 border border-slate-300 rounded-md text-sm">
                <input type="text" name="singkatan" id="singkatan_kk" placeholder="Singkatan..." required class="px-3 py-2 border border-slate-300 rounded-md text-sm uppercase">
            </div>
            <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded-md hover:bg-emerald-700 transition text-sm font-medium">Tambah Konsentrasi</button>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase w-20">Kode</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    <?php foreach($data['konsentrasi'] as $k) : ?>
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-slate-700"><?= $k['nama_konsentrasi']; ?></td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-slate-500 font-mono"><?= $k['singkatan']; ?></td>
                        <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                            <a href="<?= BASEURL; ?>/pengaturan/hapus_konsentrasi/<?= $k['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Auto generate singkatan
    document.getElementById('nama_kk').addEventListener('input', function(e) {
        const val = e.target.value;
        const singkatan = val.split(' ').map(word => word[0]).join('').toUpperCase().substring(0, 5);
        document.getElementById('singkatan_kk').value = singkatan;
    });
</script>
