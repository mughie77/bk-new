<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Edit Siswa</h1>
    <p class="text-slate-600">Perbarui data peserta didik.</p>
</div>

<div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200 max-w-md">
    <form action="<?= BASEURL; ?>/siswa/update" method="POST">
        <input type="hidden" name="id" value="<?= $data['siswa']['id']; ?>">
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">NIS</label>
                <input type="text" name="nis" value="<?= $data['siswa']['nis']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">NISN</label>
                <input type="text" name="nisn" value="<?= $data['siswa']['nisn']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Siswa</label>
                <input type="text" name="nama_siswa" value="<?= $data['siswa']['nama_siswa']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tahun Masuk</label>
                <input type="number" name="tahun_masuk" value="<?= $data['siswa']['tahun_masuk']; ?>" required class="w-full px-3 py-2 border border-slate-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
        <div class="flex justify-end gap-2 mt-6">
            <a href="<?= BASEURL; ?>/siswa" class="px-4 py-2 text-slate-600 hover:bg-slate-100 rounded-md text-sm flex items-center">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">Simpan Perubahan</button>
        </div>
    </form>
</div>
