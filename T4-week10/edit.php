<?php
require_once 'config/database.php';

$pesan = ''; // Buat nampung pesan error

//Ambil id dri url
$id = $_GET['id'] ?? 0;

//Ambil data barang berdasarkan id
$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(); // Ambil hasil query (1 baris)

// Kalau data g ada, balik ke hal utama
if (!$data) {
    header("Location: index.php");
    exit;
}

//Proses update kalau form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $kategori = trim($_POST['kategori'] ?? '');
    $jumlah = trim($_POST['jumlah'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $lokasi = trim($_POST['lokasi'] ?? '');

    // Validasi semua field harus diisi
    if (!empty($nama) && !empty($kategori) && !empty($jumlah) && !empty($harga) && !empty($lokasi)) {

        $stmt = $pdo->prepare("UPDATE barang SET 
            nama_barang = :nama,
            kategori = :kategori,
            jumlah = :jumlah,
            harga = :harga,
            lokasi = :lokasi
            WHERE id = :id");

        $stmt->execute([
            ':nama' => $nama,
            ':kategori' => $kategori,
            ':jumlah' => $jumlah,
            ':harga' => $harga,
            ':lokasi' => $lokasi,
            ':id' => $id
        ]);

        // Redirect biar ga ke-submit ulang kalau refresh
        header("Location: index.php?pesan=edit_sukses");
        exit;

    } else {
        $pesan = "Semua field wajib diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5" style="max-width: 600px;">
    <h2>Edit Barang</h2>

    <?php if ($pesan): ?>
        <div class="alert alert-danger"><?= $pesan ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Nama Barang</label>
            <input type="text" name="nama" class="form-control"
                   value="<?= htmlspecialchars($data['nama_barang']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control"
                   value="<?= htmlspecialchars($data['kategori']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control"
                   value="<?= htmlspecialchars($data['jumlah']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control"
                   value="<?= htmlspecialchars($data['harga']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control"
                   value="<?= htmlspecialchars($data['lokasi']) ?>" required>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>

    </form>
</div>

</body>
</html>