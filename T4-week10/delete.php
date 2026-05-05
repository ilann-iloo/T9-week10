<?php
require_once 'config/database.php'; // Ambil koneksi database

// Ambil id dari URL (GET), default 0 kalau ga ada
$id = $_GET['id'] ?? 0;

if ($id) {
    // Prepare query delete (biar aman dari SQL Injection)
    $stmt = $pdo->prepare("DELETE FROM barang WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

// Setelah itu langsung ke halaman utama
// Sekalian kirim parameter pesan kalau hapus sukses
header("Location: index.php?pesan=hapus_sukses");
exit;