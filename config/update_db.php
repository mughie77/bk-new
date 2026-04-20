<?php

/**
 * Script untuk memperbarui skema database secara cerdas
 * Mengecek ketersediaan tabel dan kolom secara spesifik
 */

function jalankanUpdateDatabase($db_connection, $schema_path) {
    if (!file_exists($schema_path)) {
        return [
            'success' => false,
            'message' => "File schema.sql tidak ditemukan di: " . $schema_path
        ];
    }

    // 1. Jalankan Skema Dasar (Create Table if not exists)
    $sql = file_get_contents($schema_path);
    $sql = preg_replace('/--.*?\n/', '', $sql);
    $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);
    $queries = explode(';', $sql);

    foreach ($queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            try {
                $db_connection->exec($query);
            } catch (PDOException $e) {
                // Abaikan error duplicate table/entry
            }
        }
    }

    // 2. Definisi Migrasi Kolom (Field yang mungkin baru ditambahkan di update terbaru)
    $migrations = [
        'pengaturan_sekolah' => [
            ['nip_kepala_sekolah', 'VARCHAR(50)', 'AFTER nama_kepala_sekolah']
        ],
        'konsentrasi_keahlian' => [
            ['singkatan', 'VARCHAR(10) NOT NULL', 'AFTER nama_konsentrasi']
        ],
        'guru_bk' => [
            ['nip', 'VARCHAR(50) NOT NULL UNIQUE', 'AFTER id'],
            ['pengguna_id', 'INT', 'AFTER nama_guru']
        ],
        'siswa' => [
            ['tahun_masuk', 'YEAR', 'AFTER nama_siswa']
        ],
        'mapping_siswa_kelas' => [
            ['nomor_urut', 'INT', 'AFTER kelas_id']
        ],
        'konsultasi' => [
            ['is_anonim', 'BOOLEAN DEFAULT FALSE', 'AFTER peran_konselor']
        ],
        'sosiogram' => [
            ['kelas_id', 'INT', 'AFTER relasi']
        ]
    ];

    $migrated_count = 0;
    foreach ($migrations as $table => $columns) {
        // Cek apakah tabel ada
        if (!tableExists($db_connection, $table)) continue;

        foreach ($columns as $col) {
            $colName = $col[0];
            $colType = $col[1];
            $colPos = $col[2];

            if (!columnExists($db_connection, $table, $colName)) {
                try {
                    $db_connection->exec("ALTER TABLE `$table` ADD `$colName` $colType $colPos");
                    $migrated_count++;
                } catch (PDOException $e) {
                    // Jika gagal (misal kolom sudah ada tapi beda tipe), abaikan
                }
            }
        }
    }

    return [
        'success' => true,
        'message' => "Update database selesai. $migrated_count kolom baru berhasil disinkronkan ke struktur tabel yang ada."
    ];
}

function tableExists($db, $table) {
    try {
        $result = $db->query("SHOW TABLES LIKE '$table'");
        return $result->rowCount() > 0;
    } catch (Exception $e) {
        return false;
    }
}

function columnExists($db, $table, $column) {
    try {
        $result = $db->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
        return $result->rowCount() > 0;
    } catch (Exception $e) {
        return false;
    }
}
