<?php

/**
 * Script untuk memperbarui skema database
 * Dipanggil dari Pengaturan_model atau secara mandiri
 */

function jalankanUpdateDatabase($db_connection, $schema_path) {
    if (!file_exists($schema_path)) {
        return [
            'success' => false,
            'message' => "File schema.sql tidak ditemukan di: " . $schema_path
        ];
    }

    $sql = file_get_contents($schema_path);

    // Hapus komentar SQL agar tidak mengganggu pemisahan query
    $sql = preg_replace('/--.*?\n/', '', $sql);
    $sql = preg_replace('/\/\*.*?\*\//s', '', $sql);

    // Pisahkan query berdasarkan titik koma
    $queries = explode(';', $sql);

    $success_count = 0;
    $error_count = 0;
    $ignored_count = 0;

    foreach ($queries as $query) {
        $query = trim($query);
        if (!empty($query)) {
            try {
                $db_connection->exec($query);
                $success_count++;
            } catch (PDOException $e) {
                // Tangani error duplicate (1050: table exists, 1062: duplicate entry, 1060: column exists)
                $errorCode = $e->errorInfo[1];
                if (in_array($errorCode, [1050, 1062, 1060, 1061])) {
                    $ignored_count++;
                } else {
                    $error_count++;
                    // Jika error kritis, kita bisa memilih untuk lanjut atau berhenti
                    // Di sini kita lanjut untuk query lainnya
                }
            }
        }
    }

    return [
        'success' => $error_count === 0,
        'message' => "Update selesai. $success_count query baru, $ignored_count query diabaikan (sudah ada), $error_count error."
    ];
}
