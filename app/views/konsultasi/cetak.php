<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            .no-print { display: none; }
            body { padding: 0; margin: 0; }
        }
        body { font-family: 'Times New Roman', Times, serif; }
    </style>
</head>
<body class="bg-white p-8">
    <div class="no-print mb-4 flex justify-end">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded shadow flex items-center">
            <i class="fas fa-file-pdf mr-2"></i> Cetak / Simpan PDF
        </button>
    </div>

    <!-- Header / Kop Surat -->
    <?php if(!empty($data['pengaturan']['kop_surat']) && file_exists(BASEPATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $data['pengaturan']['kop_surat'])): ?>
        <div class="mb-6">
            <img src="<?= BASEURL; ?>/uploads/<?= $data['pengaturan']['kop_surat']; ?>" class="w-full h-auto">
        </div>
    <?php else: ?>
        <div class="border-b-4 border-black pb-2 mb-6 flex items-center">
            <div class="text-center flex-1">
                <h1 class="text-2xl font-bold uppercase"><?= $data['pengaturan']['nama_sekolah']; ?></h1>
                <p class="text-sm font-semibold italic">LAPORAN KONSELING DAN BIMBINGAN SISWA</p>
                <p class="text-xs">Tahun Pelajaran <?= $data['pengaturan']['tahun_pelajaran']; ?> - Semester <?= $data['pengaturan']['semester']; ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="text-center mb-8">
        <h2 class="text-xl font-bold border-b-2 border-slate-800 inline-block px-4">LAPORAN KONSULTASI SEMESTER <?= strtoupper($data['pengaturan']['semester']); ?> TAHUN PELAJARAN <?= $data['pengaturan']['tahun_pelajaran']; ?></h2>
    </div>

    <table class="w-full mb-8 border-collapse border border-slate-300">
        <tr>
            <td class="border border-slate-300 p-2 font-bold w-1/4 bg-slate-50">Nama Peserta Didik</td>
            <td class="border border-slate-300 p-2">
                <?php if($data['konsultasi']['is_anonim']): ?>
                    <span class="font-mono font-bold"><?= $data['konsultasi']['kode_samaran']; ?></span> (Nama Disamarkan)
                <?php else: ?>
                    <?= $data['konsultasi']['nama_siswa']; ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td class="border border-slate-300 p-2 font-bold bg-slate-50">Kelas / Konsentrasi</td>
            <td class="border border-slate-300 p-2"><?= $data['konsultasi']['nama_kelas']; ?> / <?= $data['konsultasi']['nama_konsentrasi']; ?></td>
        </tr>
        <tr>
            <td class="border border-slate-300 p-2 font-bold bg-slate-50">Hari / Tanggal</td>
            <td class="border border-slate-300 p-2"><?= date('l, d F Y', strtotime($data['konsultasi']['tanggal'])); ?></td>
        </tr>
        <tr>
            <td class="border border-slate-300 p-2 font-bold bg-slate-50">Durasi</td>
            <td class="border border-slate-300 p-2"><?= $data['konsultasi']['waktu_menit']; ?> Menit</td>
        </tr>
        <tr>
            <td class="border border-slate-300 p-2 font-bold bg-slate-50">Konsultan / Narasumber</td>
            <td class="border border-slate-300 p-2"><?= $data['konsultasi']['konsultan']; ?></td>
        </tr>
        <tr>
            <td class="border border-slate-300 p-2 font-bold bg-slate-50">Topik Pembahasan</td>
            <td class="border border-slate-300 p-2 h-40 align-top"><?= nl2br($data['konsultasi']['topik']); ?></td>
        </tr>
    </table>

    <!-- Footer / TTD -->
    <div class="grid grid-cols-2 gap-8 mt-12">
        <div class="text-center">
            <p>Mengetahui,</p>
            <p>Kepala Sekolah</p>
            <br><br><br><br>
            <p class="font-bold underline"><?= $data['pengaturan']['nama_kepala_sekolah']; ?></p>
            <p>NIP. <?= $data['pengaturan']['nip_kepala_sekolah']; ?></p>
        </div>
        <div class="text-center">
            <p><?= date('d F Y'); ?></p>
            <p>Guru Pembimbing / Konselor</p>
            <br><br><br><br>
            <p class="font-bold underline"><?= $data['konsultasi']['guru_pengampu'] ?? $data['konsultasi']['konsultan']; ?></p>
            <p>NIP. <?= $data['konsultasi']['nip_guru_pengampu'] ?? '-'; ?></p>
        </div>
    </div>

</body>
</html>
