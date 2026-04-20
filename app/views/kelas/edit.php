<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Edit Kelas</h1>
    <p class="text-slate-600">Perbarui informasi rombongan belajar.</p>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200 max-w-md">
    <form action="<?= BASEURL; ?>/kelas/update" method="POST">
        <input type="hidden" name="id" value="<?= $data['kelas']['id']; ?>">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kelas</label>
                <input type="text" name="nama_kelas" value="<?= $data['kelas']['nama_kelas']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konsentrasi Keahlian</label>
                <select name="konsentrasi_id" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Pilih Konsentrasi --</option>
                    <?php foreach($data['konsentrasi'] as $kk) : ?>
                        <option value="<?= $kk['id']; ?>" <?= $data['kelas']['konsentrasi_id'] == $kk['id'] ? 'selected' : ''; ?>><?= $kk['nama_konsentrasi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="flex justify-end gap-2 mt-6">
            <a href="<?= BASEURL; ?>/kelas" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-md text-sm flex items-center">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
