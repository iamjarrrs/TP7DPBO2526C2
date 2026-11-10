<?php
require_once '../class/barang.php';
require_once '../class/kategori.php';

$barangObj = new Barang();
$kategoriObj = new Kategori();

if (isset($_POST['submit'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_barang = $_POST['nama_barang'];
    $stok = $_POST['stok'];

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $barangObj->update($_POST['id'], $id_kategori, $nama_barang, $stok);
    } else {
        $barangObj->create($id_kategori, $nama_barang, $stok);
    }
    header("Location: barang.php");
    exit;
}

if (isset($_GET['delete'])) {
    $barangObj->delete($_GET['delete']);
    header("Location: barang.php");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $barangObj->getById($_GET['edit']);
}

$barangList = $barangObj->getAll();
$kategoriList = $kategoriObj->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Barang</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header class="navbar">
        <a class="brand" href="../index.php">Inventaris BEM</a>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a href="kategori.php">Kategori</a>
            <a class="active" href="barang.php">Barang</a>
            <a href="peminjaman.php">Peminjaman</a>
        </nav>
    </header>

    <div class="container">
        <h2>Kelola Barang</h2>
        
        <div class="form-card">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategoriList as $kat): ?>
                            <option value="<?php echo $kat['id']; ?>" <?php echo (isset($editData) && $editData['id_kategori'] == $kat['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($kat['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" value="<?php echo $editData['nama_barang'] ?? ''; ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?php echo $editData['stok'] ?? ''; ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary"><?php echo $editData ? 'Update' : 'Simpan'; ?></button>
                <?php if ($editData): ?>
                    <a href="barang.php" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($barangList as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($row['nama_kategori']); ?></td>
                    <td><?php echo htmlspecialchars($row['stok']); ?></td>
                    <td>
                        <a href="barang.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="barang.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus barang ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
