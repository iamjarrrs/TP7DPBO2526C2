<?php
require_once '../class/peminjam.php';
require_once '../class/barang.php';

$peminjamObj = new Peminjam();
$barangObj = new Barang();

if (isset($_POST['submit'])) {
    $id_barang = $_POST['id_barang'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $jumlah_pinjam = $_POST['jumlah_pinjam'];
    $status = $_POST['status'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $peminjamObj->update($_POST['id'], $id_barang, $nama_peminjam, $jumlah_pinjam, $status);
    } else {
        $peminjamObj->create($id_barang, $nama_peminjam, $jumlah_pinjam, $status);
    }
    header("Location: peminjaman.php");
    exit;
}

if (isset($_GET['delete'])) {
    $peminjamObj->delete($_GET['delete']);
    header("Location: peminjaman.php");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $peminjamObj->getById($_GET['edit']);
}

$peminjamanList = $peminjamObj->getAll();
$barangList = $barangObj->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Peminjaman</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header class="navbar">
        <a class="brand" href="../index.php">Inventaris BEM</a>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="kategori.php">Kategori</a>
            <a href="barang.php">Barang</a>
            <a class="active" href="peminjaman.php">Peminjaman</a>
        </nav>
    </header>

    <div class="container">
        <h2>Kelola Peminjaman Inventaris</h2>
        
        <div class="form-card">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
                <div class="form-group">
                    <label class="form-label">Barang</label>
                    <select name="id_barang" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php foreach ($barangList as $brg): ?>
                            <option value="<?php echo $brg['id']; ?>" <?php echo (isset($editData) && $editData['id_barang'] == $brg['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($brg['nama_barang']); ?> (Stok: <?php echo $brg['stok']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" class="form-control" value="<?php echo $editData['nama_peminjam'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Pinjam</label>
                    <input type="number" name="jumlah_pinjam" class="form-control" value="<?php echo $editData['jumlah_pinjam'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="dipinjam" <?php echo (isset($editData) && $editData['status'] == 'dipinjam') ? 'selected' : ''; ?>>Dipinjam</option>
                        <option value="dikembalikan" <?php echo (isset($editData) && $editData['status'] == 'dikembalikan') ? 'selected' : ''; ?>>Dikembalikan</option>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary"><?php echo $editData ? 'Update' : 'Simpan'; ?></button>
                <?php if ($editData): ?>
                    <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($peminjamanList as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_peminjam']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($row['jumlah_pinjam']); ?></td>
                    <td>
                        <span class="badge <?php echo $row['status'] == 'dipinjam' ? 'badge-warning' : 'badge-success'; ?>">
                            <?php echo htmlspecialchars($row['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="peminjaman.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="peminjaman.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus data peminjaman ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
