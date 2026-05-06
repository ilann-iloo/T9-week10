<?php

$host = "localhost"; // Alamat server database
$dbname = "inventaris_db"; // Nama database yang dipakai
$user = "root";
$pass = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4", //DSN untuk koneksi ke MySQL
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Biar error langsung keliatan (tidak diam-diam gagal)
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Hasil query jadi array asosiatif
        ]
    );
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage()); // Kalau koneksi gagal, nampilin pesan error
}