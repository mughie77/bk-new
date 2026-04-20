<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Visualisasi Sosiogram</h1>
        <p class="text-slate-600">Analisis hubungan sosial antar siswa dalam satu kelas.</p>
    </div>
    <?php if($data['selected_kelas']) : ?>
    <button id="downloadBtn" class="bg-emerald-600 text-white px-4 py-2 rounded-md text-sm hover:bg-emerald-700 transition flex items-center shadow-sm">
        <i class="fas fa-download mr-2"></i> Download Laporan Lengkap
    </button>
    <?php endif; ?>
</div>

<?php if(isset($_SESSION['flash'])) : ?>
    <div class="p-4 mb-4 text-sm <?= $_SESSION['flash']['tipe'] == 'success' ? 'text-emerald-700 bg-emerald-100' : 'text-red-700 bg-red-100' ?> rounded-lg" role="alert">
        <?= $_SESSION['flash']['pesan']; ?>
        <?php unset($_SESSION['flash']); ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Sidebar Kelas & Input -->
    <div class="space-y-6 no-capture">
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

    <!-- Area Visualisasi untuk di-Capture -->
    <div class="lg:col-span-3 space-y-6" id="capture-area">
        <?php if($data['selected_kelas']) : ?>
            <div class="bg-white p-8 rounded-lg shadow-sm border border-slate-200">
                <div class="mb-6 text-center border-b pb-4">
                    <h2 class="text-xl font-bold text-slate-800 uppercase">Laporan Sosiogram</h2>
                    <?php
                        $nama_kelas_aktif = '';
                        foreach($data['kelas'] as $k) if($k['id'] == $data['selected_kelas']) $nama_kelas_aktif = $k['nama_kelas'];
                    ?>
                    <p class="text-slate-600">Kelas: <?= $nama_kelas_aktif; ?></p>
                </div>

                <div id="sosiogram-container" class="w-full h-[550px] bg-white border border-slate-100 rounded-xl relative overflow-hidden">
                    <!-- vis.js will render here -->
                </div>

                <div class="mt-8">
                    <h4 class="font-bold text-slate-800 mb-4 text-sm border-b pb-2 uppercase tracking-wide">Detail Hubungan Antar Siswa:</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-2">
                        <?php if(empty($data['relasi'])) : ?>
                            <p class="text-slate-400 italic text-xs">Belum ada data relasi.</p>
                        <?php endif; ?>
                        <?php foreach($data['relasi'] as $r) : ?>
                            <div class="flex justify-between items-center p-2 border-b border-slate-50 text-[11px]">
                                <div class="flex-1">
                                    <span class="font-bold text-slate-700"><?= $r['sumber']; ?></span>
                                    <span class="text-slate-400 mx-1">&rarr;</span>
                                    <span class="text-blue-600 font-medium italic"><?= $r['relasi']; ?></span>
                                    <span class="text-slate-400 mx-1">&rarr;</span>
                                    <span class="font-bold text-slate-700"><?= $r['target']; ?></span>
                                </div>
                                <a href="<?= BASEURL; ?>/sosiogram/hapus/<?= $r['id']; ?>/<?= $data['selected_kelas']; ?>" class="text-slate-300 hover:text-red-600 transition ml-2 no-capture" title="Hapus">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mt-12 pt-6 border-t border-slate-100 text-[10px] text-slate-400 text-right italic">
                    Dicetak otomatis melalui Aplikasi BK Sekolah pada <?= date('d/m/Y H:i'); ?>
                </div>
            </div>
        <?php else : ?>
            <div class="bg-blue-50 p-12 rounded-2xl border-2 border-dashed border-blue-200 text-center text-blue-600">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-project-diagram text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Visualisasi Sosiogram</h3>
                <p class="text-blue-500 max-w-md mx-auto">Silakan pilih kelas terlebih dahulu dari panel di samping untuk melihat pemetaan jaringan sosial peserta didik.</p>
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
                    $words = explode(' ', $s['nama_siswa']);
                    $initial = '';
                    foreach($words as $w) $initial .= substr($w, 0, 1);
                    $initial = strtoupper(substr($initial, 0, 2));

                    $unique_siswa[] = "{
                        id: {$s['id']},
                        label: '{$initial}',
                        title: '{$s['nama_siswa']}',
                        shape: 'circle',
                        color: {
                            background: '#3b82f6',
                            border: '#2563eb',
                            highlight: { background: '#60a5fa', border: '#3b82f6' }
                        },
                        font: { color: '#ffffff', size: 14, face: 'Poppins', weight: 'bold' },
                        shadow: true
                    }";
                }
                echo implode(',', $unique_siswa);
                ?>
            ]);

            const edges = new vis.DataSet([
                <?php
                $relasi_arr = [];
                foreach($data['relasi'] as $r) {
                    $relasi_arr[] = "{
                        from: {$r['siswa_sumber_id']},
                        to: {$r['siswa_target_id']},
                        label: '{$r['relasi']}',
                        arrows: 'to',
                        color: { color: '#94a3b8', highlight: '#3b82f6' },
                        font: { align: 'top', size: 9, face: 'Poppins', strokeWidth: 2, strokeColor: '#ffffff' },
                        width: 1,
                        smooth: { type: 'curvedCW', roundness: 0.2 }
                    }";
                }
                echo implode(',', $relasi_arr);
                ?>
            ]);

            const container = document.getElementById('sosiogram-container');
            const data = { nodes: nodes, edges: edges };
            const options = {
                nodes: { borderWidth: 2, size: 25 },
                edges: { selectionWidth: 3 },
                physics: {
                    enabled: true,
                    forceAtlas2Based: { gravitationalConstant: -100, centralGravity: 0.01, springLength: 150 },
                    solver: 'forceAtlas2Based',
                    stabilization: { iterations: 200 }
                }
            };
            const network = new vis.Network(container, data, options);

            // Download Function
            document.getElementById('downloadBtn').addEventListener('click', function() {
                const btn = this;
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Mengolah Laporan...';

                // Sembunyikan elemen yang tidak ingin di capture
                document.querySelectorAll('.no-capture').forEach(el => el.style.display = 'none');

                html2canvas(document.getElementById('capture-area'), {
                    backgroundColor: '#ffffff',
                    scale: 2,
                    useCORS: true,
                    logging: false
                }).then(canvas => {
                    const link = document.createElement('a');
                    link.download = 'Laporan-Sosiogram-<?= $nama_kelas_aktif; ?>.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();

                    // Kembalikan elemen yang disembunyikan
                    document.querySelectorAll('.no-capture').forEach(el => el.style.display = '');

                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-download mr-2"></i> Download Laporan Lengkap';
                });
            });
        <?php endif; ?>
    });
</script>
