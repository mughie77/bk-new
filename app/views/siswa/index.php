<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <h1 class="text-2xl font-black text-slate-800 tracking-tight">Data Siswa</h1>
        <p class="text-sm text-slate-500">Kelola daftar peserta didik aktif.</p>
    </div>
    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
        <button onclick="document.getElementById('modal-import').classList.remove('hidden')" class="bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white px-6 py-3 rounded-2xl font-bold text-sm transition flex items-center justify-center border border-emerald-100">
            <i class="fas fa-file-excel mr-2"></i> Import Excel
        </button>
        <button onclick="document.getElementById('modal-siswa').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-sm transition shadow-lg shadow-blue-200 flex items-center justify-center">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Siswa
        </button>
    </div>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-50 border-emerald-100' : 'text-red-700 bg-red-50 border-red-100' ?> rounded-2xl border flex items-center" role="alert">
        <i class="fas <?= $_SESSION['flash']['tipe'] == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' ?> mr-2"></i>
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto custom-scrollbar">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="bg-slate-50/50">
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">NIS / NISN</th>
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Identitas Siswa</th>
                    <th class="px-8 py-5 text-left text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Thn Masuk</th>
                    <th class="px-8 py-5 text-right text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php if(empty($data['siswa'])) : ?>
                    <tr><td colspan="4" class="px-8 py-10 text-center text-slate-400 italic">Belum ada data siswa.</td></tr>
                <?php endif; ?>
                <?php foreach($data['siswa'] as $s) : ?>
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-8 py-5 whitespace-nowrap">
                        <span class="text-xs font-bold text-slate-800"><?= $s['nis']; ?></span>
                        <span class="block text-[10px] text-slate-400 mt-0.5"><?= $s['nisn']; ?></span>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold mr-3 uppercase">
                                <?= substr($s['nama_siswa'], 0, 1); ?>
                            </div>
                            <span class="text-sm font-semibold text-slate-700 group-hover:text-blue-700 transition-colors"><?= $s['nama_siswa']; ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-[10px] font-bold rounded-full uppercase"><?= $s['tahun_masuk']; ?></span>
                    </td>
                    <td class="px-8 py-5 whitespace-nowrap text-right">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="<?= BASEURL; ?>/siswa/edit/<?= $s['id']; ?>" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <i class="fas fa-pen text-xs"></i>
                            </a>
                            <a href="<?= BASEURL; ?>/siswa/hapus/<?= $s['id']; ?>" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm" onclick="return confirm('Hapus siswa ini?')">
                                <i class="fas fa-trash text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
        <p class="text-xs font-medium text-slate-500">Page <span class="text-slate-800"><?= $data['halaman_aktif']; ?></span> of <?= $data['total_halaman']; ?></p>
        <div class="flex items-center space-x-2">
            <?php if($data['halaman_aktif'] > 1) : ?>
                <a href="<?= BASEURL; ?>/siswa/index/<?= $data['halaman_aktif'] - 1; ?>" class="h-9 px-4 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 flex items-center hover:bg-slate-50 transition shadow-sm">
                    <i class="fas fa-chevron-left mr-2"></i> Previous
                </a>
            <?php endif; ?>

            <?php if($data['halaman_aktif'] < $data['total_halaman']) : ?>
                <a href="<?= BASEURL; ?>/siswa/index/<?= $data['halaman_aktif'] + 1; ?>" class="h-9 px-4 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 flex items-center hover:bg-slate-50 transition shadow-sm">
                    Next <i class="fas fa-chevron-right ml-2"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal Import Excel -->
<div id="modal-import" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-[60] p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-lg p-8 md:p-10 shadow-2xl scale-in transition-transform">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="text-2xl font-black text-slate-800">Import Data Siswa</h3>
                <p class="text-sm text-slate-500">Unggah file Excel (.xlsx) untuk import masal.</p>
            </div>
            <button onclick="document.getElementById('modal-import').classList.add('hidden')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="space-y-6">
            <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                <h4 class="text-xs font-bold text-blue-700 uppercase tracking-wider mb-2">Format Header Excel:</h4>
                <p class="text-[11px] text-blue-600 leading-relaxed font-mono">nis | nisn | nama_siswa | tahun_masuk</p>
            </div>

            <div class="relative group">
                <input type="file" id="excelFile" accept=".xlsx" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <div class="border-2 border-dashed border-slate-200 rounded-[2rem] p-10 flex flex-col items-center justify-center group-hover:border-blue-400 transition-colors">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 group-hover:bg-blue-50 group-hover:text-blue-500 transition-all mb-4">
                        <i class="fas fa-cloud-upload-alt text-2xl"></i>
                    </div>
                    <span id="fileName" class="text-sm font-bold text-slate-400">Pilih file .xlsx</span>
                </div>
            </div>

            <div id="importProgress" class="hidden">
                <div class="w-full bg-slate-100 rounded-full h-1.5 mb-2">
                    <div id="progressBar" class="bg-blue-600 h-1.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
                <p id="statusText" class="text-[10px] font-bold text-slate-400 uppercase text-center">Memproses data...</p>
            </div>

            <button id="processBtn" disabled class="w-full py-4 bg-slate-100 text-slate-400 rounded-2xl font-bold text-sm transition cursor-not-allowed">Mulai Import</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    const fileInput = document.getElementById('excelFile');
    const fileNameDisplay = document.getElementById('fileName');
    const processBtn = document.getElementById('processBtn');
    let excelData = [];

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            fileNameDisplay.innerText = file.name;
            fileNameDisplay.classList.remove('text-slate-400');
            fileNameDisplay.classList.add('text-blue-600');

            processBtn.disabled = false;
            processBtn.classList.remove('bg-slate-100', 'text-slate-400', 'cursor-not-allowed');
            processBtn.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700', 'shadow-lg', 'shadow-blue-200');

            const reader = new FileReader();
            reader.onload = function(evt) {
                const bstr = evt.target.result;
                const wb = XLSX.read(bstr, { type: 'binary' });
                const wsname = wb.SheetNames[0];
                const ws = wb.Sheets[wsname];
                excelData = XLSX.utils.sheet_to_json(ws);
                console.log('Parsed Data:', excelData);
            };
            reader.readAsBinaryString(file);
        }
    });

    processBtn.addEventListener('click', async function() {
        if (excelData.length === 0) return alert('Data Excel kosong atau tidak terbaca');

        this.disabled = true;
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengimport...';
        document.getElementById('importProgress').classList.remove('hidden');

        try {
            const response = await fetch('<?= BASEURL; ?>/siswa/import', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(excelData)
            });

            const result = await response.json();

            if (result.status === 'success') {
                document.getElementById('progressBar').style.width = '100%';
                document.getElementById('statusText').innerText = result.message;
                setTimeout(() => location.reload(), 1500);
            } else {
                alert(result.message);
                location.reload();
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengimport data');
            location.reload();
        }
    });
</script>
<div id="modal-siswa" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center z-[60] p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-lg p-8 md:p-10 shadow-2xl scale-in transition-transform">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h3 class="text-2xl font-black text-slate-800">Tambah Siswa</h3>
                <p class="text-sm text-slate-500">Registrasi peserta didik baru.</p>
            </div>
            <button onclick="document.getElementById('modal-siswa').classList.add('hidden')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="<?= BASEURL; ?>/siswa/tambah" method="POST" class="space-y-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 ml-1">Nomor Induk Siswa (NIS)</label>
                    <input type="text" name="nis" required placeholder="001234" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-700 ml-1">NISN Nasional</label>
                    <input type="text" name="nisn" required placeholder="00054321" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-700 ml-1">Nama Lengkap Siswa</label>
                <input type="text" name="nama_siswa" required placeholder="Ahmad Dani" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm font-semibold">
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-700 ml-1">Tahun Masuk Sekolah</label>
                <input type="number" name="tahun_masuk" value="<?= date('Y'); ?>" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition outline-none text-sm">
            </div>
            <div class="flex gap-3 pt-6">
                <button type="button" onclick="document.getElementById('modal-siswa').classList.add('hidden')" class="flex-1 px-6 py-4 bg-slate-100 text-slate-600 rounded-2xl font-bold text-sm hover:bg-slate-200 transition">Batal</button>
                <button type="submit" class="flex-[2] px-6 py-4 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-200">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
