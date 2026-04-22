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
            .no-print { display: none !important; }
            body { padding: 0; margin: 0; }
        }
        body { font-family: 'Times New Roman', Times, serif; color: #000; }
        table td, table th { padding: 8px !important; border: 1px solid #000 !important; }
    </style>
</head>
<body class="bg-white p-8">
    <div class="no-print mb-4 flex justify-end">
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded shadow flex items-center">
            <i class="fas fa-file-pdf mr-2"></i> Cetak / Simpan PDF
        </button>
    </div>

    <!-- Header / Kop Surat -->
    <?php
    $kop_path = BASEPATH . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $data['pengaturan']['kop_surat'];
    if(!empty($data['pengaturan']['kop_surat']) && file_exists($kop_path)):
    ?>
        <div class="mb-6 border-b-4 border-black pb-2 text-center">
            <img src="<?= BASEURL; ?>/uploads/<?= $data['pengaturan']['kop_surat']; ?>" class="h-auto max-h-32 inline-block">
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
        <h2 class="text-xl font-bold px-4">
            LAPORAN KONSULTASI <br />
            SEMESTER <?= strtoupper($data['pengaturan']['semester']); ?> <br />
            TAHUN PELAJARAN <?= $data['pengaturan']['tahun_pelajaran']; ?>
        </h2>
    </div>

    <?php
        // Tanggal Bahasa Indonesia
        $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
        $bulan = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];

        $tgl = strtotime($data['konsultasi']['tanggal']);
        $hari_id = $hari[date('l', $tgl)];
        $tgl_id = date('d', $tgl) . ' ' . $bulan[(int)date('m', $tgl)] . ' ' . date('Y', $tgl);
    ?>

    <table class="w-full mb-8 border-collapse border border-black">
        <thead>
            <tr class="bg-slate-100">
                <th class="text-center w-[5%] font-bold">No</th>
                <th class="text-left w-[35%] font-bold">Uraian / Judul</th>
                <th class="text-left font-bold">Keterangan / Isi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">1</td>
                <td class="font-bold">Nama peserta didik/Konseli</td>
                <td>
                    <?php if($data['konsultasi']['is_anonim']): ?>
                        <span class="font-mono font-bold"><?= $data['konsultasi']['kode_samaran']; ?></span> (Nama Disamarkan)
                    <?php else: ?>
                        <?= $data['konsultasi']['nama_siswa']; ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td class="font-bold">Kelas /Semester</td>
                <td><?= $data['konsultasi']['nama_kelas']; ?> / <?= $data['pengaturan']['semester']; ?></td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td class="font-bold">Hari / Tanggal</td>
                <td><?= $hari_id . ', ' . $tgl_id; ?></td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td class="font-bold">Waktu</td>
                <td><?= $data['konsultasi']['waktu_menit']; ?> Menit</td>
            </tr>
            <tr>
                <td class="text-center">5</td>
                <td class="font-bold">Topik pembahasan</td>
                <td class="whitespace-pre-wrap leading-relaxed"><?= nl2br($data['konsultasi']['topik']); ?></td>
            </tr>
            <tr>
                <td class="text-center">6</td>
                <td class="font-bold">Konsultan / Nara Sumber</td>
                <td><?= $data['konsultasi']['konsultan']; ?></td>
            </tr>
            <tr>
                <td class="text-center">7</td>
                <td class="font-bold">Peran Guru Bimbingan dan Konseling atau Konselor</td>
                <td><?= $data['konsultasi']['peran_konselor']; ?></td>
            </tr>
        </tbody>
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
            <p><?= $tgl_id; ?></p>
            <p>Guru Pembimbing / Konselor</p>
            <br><br><br><br>
            <p class="font-bold underline"><?= $data['konsultasi']['guru_pengampu'] ?? $data['konsultasi']['konsultan']; ?></p>
            <p>NIP. <?= $data['konsultasi']['nip_guru_pengampu'] ?? '-'; ?></p>
        </div>
    </div>

</body>
</html>
