CREATE DATABASE inventaris_db;
USE inventaris_db;

CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(150) NOT NULL,
    kategori VARCHAR(100) NOT NULL,
    jumlah INT DEFAULT 0,
    harga DECIMAL(12,2) NOT NULL,
    lokasi VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
