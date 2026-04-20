<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Visualisasi Sosiogram</h1>
    <p class="text-slate-600">Analisis hubungan sosial antar siswa dalam satu kelas.</p>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 mb-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-100' : 'text-red-700 bg-red-100' ?> rounded-lg" role="alert">
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Sidebar Kelas & Input -->
    <div class="space-y-6">
        <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200">
            <h3 class="font-semibold text-slate-800 mb-3 border-b pb-2">Pilih Kelas</h3>
            <div class="space-y-1">
                <?php foreach($data['kelas'] as $k) : ?>
                    <a href="<?= BASEURL; ?>/sosiogram/index/<?= $k['id']; ?>" class="block px-3 py-2 rounded-md text-sm <?= $data['selected_kelas'] == $k['id'] ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-100' ?>">
                        <?= $k['nama_kelas']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if($data['selected_kelas']) : ?>
        <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200">
            <h3 class="font-semibold text-slate-800 mb-3 border-b pb-2">Tambah Relasi</h3>
            <form action="<?= BASEURL; ?>/sosiogram/tambah" method="POST" class="space-y-3">
                <input type="hidden" name="kelas_id" value="<?= $data['selected_kelas']; ?>">
                <div>
                    <label class="block text-xs font-medium text-slate-500 uppercase">Siswa Sumber</label>
                    <select name="siswa_sumber_id" required class="mt-1 block w-full px-2 py-1 text-sm border border-slate-300 rounded-md">
                        <option value="">-- Pilih --</option>
                        <?php foreach($data['siswa_di_kelas'] as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nama_siswa']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 uppercase">Siswa Target</label>
                    <select name="siswa_target_id" required class="mt-1 block w-full px-2 py-1 text-sm border border-slate-300 rounded-md">
                        <option value="">-- Pilih --</option>
                        <?php foreach($data['siswa_di_kelas'] as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nama_siswa']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-500 uppercase">Jenis Relasi</label>
                    <input type="text" name="relasi" placeholder="Misal: Teman Dekat" required class="mt-1 block w-full px-2 py-1 text-sm border border-slate-300 rounded-md">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md text-sm hover:bg-blue-700 transition">Tambah Relasi</button>
            </form>
        </div>
        <?php endif; ?>
    </div>

    <!-- Visualisasi -->
    <div class="lg:col-span-3 space-y-6">
        <?php if($data['selected_kelas']) : ?>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-slate-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-slate-800 italic text-blue-700">Graf Sosiogram</h3>
                    <button id="downloadBtn" class="bg-emerald-600 text-white px-4 py-2 rounded-md text-sm hover:bg-emerald-700 transition">
                        <i class="fas fa-download mr-1"></i> Download Gambar
                    </button>
                </div>

                <div id="sosiogram-container" class="w-full h-[500px] bg-slate-50 border border-slate-200 rounded-lg relative overflow-hidden">
                    <!-- vis.js will render here -->
                </div>

                <div class="mt-6">
                    <h4 class="font-semibold text-sm mb-2">Daftar Relasi Terdaftar:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <?php foreach($data['relasi'] as $r) : ?>
                            <div class="flex justify-between items-center p-2 bg-slate-50 rounded border border-slate-100 text-xs">
                                <span><strong><?= $r['sumber']; ?></strong> &rarr; <?= $r['relasi']; ?> &rarr; <strong><?= $r['target']; ?></strong></span>
                                <a href="<?= BASEURL; ?>/sosiogram/hapus/<?= $r['id']; ?>/<?= $data['selected_kelas']; ?>" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="bg-blue-50 p-8 rounded-lg border border-blue-100 text-center text-blue-600">
                <i class="fas fa-project-diagram text-4xl mb-4 block"></i>
                Silakan pilih kelas terlebih dahulu untuk melihat visualisasi sosiogram.
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Scripts for Sosiogram -->
<script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        <?php if($data['selected_kelas']) : ?>
            // Prepare Data for vis.js
            const nodes = new vis.DataSet([
                <?php
                $unique_siswa = [];
                foreach($data['siswa_di_kelas'] as $s) {
                    $unique_siswa[] = "{id: {$s['id']}, label: '{$s['nama_siswa']}', color: '#3b82f6', font: {color: '#ffffff'}}";
                }
                echo implode(',', $unique_siswa);
                ?>
            ]);

            const edges = new vis.DataSet([
                <?php
                $relasi_arr = [];
                foreach($data['relasi'] as $r) {
                    $relasi_arr[] = "{from: {$r['siswa_sumber_id']}, to: {$r['siswa_target_id']}, label: '{$r['relasi']}', arrows: 'to', font: {align: 'top', size: 10}}";
                }
                echo implode(',', $relasi_arr);
                ?>
            ]);

            const container = document.getElementById('sosiogram-container');
            const data = { nodes: nodes, edges: edges };
            const options = {
                nodes: {
                    shape: 'dot',
                    size: 16
                },
                physics: {
                    enabled: true,
                    barnesHut: {
                        gravitationalConstant: -2000,
                        centralGravity: 0.3,
                        springLength: 95
                    }
                }
            };
            const network = new vis.Network(container, data, options);

            // Download Function
            document.getElementById('downloadBtn').addEventListener('click', function() {
                html2canvas(document.getElementById('sosiogram-container')).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'sosiogram-<?= $data['selected_kelas']; ?>.png';
                    link.href = canvas.toDataURL();
                    link.click();
                });
            });
        <?php endif; ?>
    });
</script>
