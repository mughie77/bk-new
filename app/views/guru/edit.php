<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Edit Guru BK</h1>
    <p class="text-slate-600">Perbarui informasi guru pembimbing.</p>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200 max-w-md">
    <form action="<?= BASEURL; ?>/guru/update" method="POST">
        <input type="hidden" name="id" value="<?= $data['guru']['id']; ?>">
        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">NIP</label>
            <input type="text" name="nip" value="<?= $data['guru']['nip']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
            <input type="text" name="nama_guru" value="<?= $data['guru']['nama_guru']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="flex justify-end gap-2">
            <a href="<?= BASEURL; ?>/guru" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-md text-sm flex items-center">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
