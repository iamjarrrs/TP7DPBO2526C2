<?php
require_once '../class/kategori.php';
$kategoriObj = new Kategori();

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_kategori'];
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $kategoriObj->update($_POST['id'], $nama);
    } else {
        $kategoriObj->create($nama);
    }
    header("Location: kategori.php");
    exit;
}

if (isset($_GET['delete'])) {
    $kategoriObj->delete($_GET['delete']);
    header("Location: kategori.php");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $kategoriObj->getById($_GET['edit']);
}

$kategoriList = $kategoriObj->getAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kategori</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header class="navbar">
        <a class="brand" href="../index.php">Inventaris BEM</a>
        <nav>
            <a href="../index.php">Dashboard</a>
            <a class="active" href="kategori.php">Kategori</a>
            <a href="barang.php">Barang</a>
            <a href="peminjaman.php">Peminjaman</a>
        </nav>
    </header>

    <div class="container">
        <h2>Kelola Kategori</h2>
        
        <div class="form-card">
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
                <div class="form-group">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" value="<?php echo $editData['nama_kategori'] ?? ''; ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary"><?php echo $editData ? 'Update' : 'Simpan'; ?></button>
                <?php if ($editData): ?>
                    <a href="kategori.php" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($kategoriList as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_kategori']); ?></td>
                    <td>
                        <a href="kategori.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="kategori.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
