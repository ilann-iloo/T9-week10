<?php
require_once 'config/database.php'; // Ambil koneksi database

// Ambil semua data barang
$stmt = $pdo->query("SELECT * FROM barang ORDER BY id DESC");
$barang = $stmt->fetchAll(); // Ambil semua data jadi array

// Pesan notifikasi
$pesan = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Data Inventaris</h2>
    
    <?php if ($pesan === 'tambah_sukses'): ?>
        <div class="alert alert-success alert-dismissible fade show">
            Data berhasil ditambahkan!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php elseif ($pesan === 'edit_sukses'): ?>
        <div class="alert alert-info">Data berhasil diupdate!</div>
    <?php elseif ($pesan === 'hapus_sukses'): ?>
        <div class="alert alert-warning">Data berhasil dihapus!</div>
    <?php endif; ?>

    <a href="create.php" class="btn btn-success mb-3">+ Tambah Barang</a>
    
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th width="60">No</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Lokasi</th>
                <th>Created At</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php if (count($barang) > 0): ?>
            <?php $no = 1; ?>
            <?php foreach ($barang as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                    <td><?= htmlspecialchars($row['kategori']) ?></td>
                    <td><?= htmlspecialchars($row['jumlah']) ?></td>
                    <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
                    <td><?= htmlspecialchars($row['lokasi']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>

                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">Belum ada data.</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <p class="text-muted">Total: <?= count($barang) ?> barang</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>