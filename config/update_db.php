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
    $errors = [];

    try {
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $db_connection->exec($query);
                $success_count++;
            }
        }
        return [
            'success' => true,
            'message' => "Update database berhasil. ($success_count query dijalankan)"
        ];
    } catch (PDOException $e) {
        return [
            'success' => false,
            'message' => "Gagal mengeksekusi query: " . $e->getMessage()
        ];
    }
}
