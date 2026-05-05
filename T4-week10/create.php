<?php
require_once 'config/database.php';
$pesan = ''; // Variabel buat nampung pesan error

// Ambil data dari form + trim biar ga ada spasi aneh
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $jumlah = trim($_POST['jumlah'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $lokasi = trim($_POST['lokasi'] ?? '');

    // Validasiin semua field harus diisi
    if (!empty($nama) && !empty($kategori) && !empty($jumlah) && !empty($harga) && !empty($lokasi)) {
        $stmt = $pdo->prepare("INSERT INTO barang (nama_barang, kategori, jumlah, harga, lokasi) 
                               VALUES (:nama, :kategori, :jumlah, :harga, :lokasi)");
        // Eksekusi query dengan data dari form
        $stmt->execute([
            ':nama' => $nama,
            ':kategori' => $kategori,
            ':jumlah' => $jumlah,
            ':harga' => $harga,
            ':lokasi' => $lokasi
        ]);

        // biar ga double submit kalau refres
        header("Location: index.php?pesan=tambah_sukses");
        exit;
    } else {
        // Kalau ada field kosong
        $pesan = "Semua field wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
 
<div class="container mt-5" style="max-width: 580px;">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Barang</h5>
        </div>
        <div class="card-body">
 
            <?php if ($pesan): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($pesan) ?></div>
            <?php endif; ?>
 
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Laptop Dell XPS" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Contoh: Elektronik" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="0" min="0" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" placeholder="0" min="0" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Gudang A" required>
                </div>
 
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
 
        </div>
    </div>
</div>
 
</body>
</html>