<?php
require_once 'class/kategori.php';
require_once 'class/barang.php';
require_once 'class/peminjam.php';

$kategoriObj = new Kategori();
$barangObj = new Barang();
$peminjamObj = new Peminjam();

$totalKategori = count($kategoriObj->getAll());
$totalBarang = count($barangObj->getAll());
$totalPeminjaman = count($peminjamObj->getAll());
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Peminjaman Inventaris BEM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="navbar">
        <a class="brand" href="index.php">Inventaris BEM</a>
        <nav>
            <a class="active" href="index.php">Dashboard</a>
            <a href="view/kategori.php">Kategori</a>
            <a href="view/barang.php">Barang</a>
            <a href="view/peminjaman.php">Peminjaman</a>
        </nav>
    </header>

    <div class="container">
        <h1>Dashboard Peminjaman Inventaris BEM</h1>
        <p style="color: #6b7280;">Selamat datang di sistem manajemen inventaris BEM.</p>
        
        <div class="card-grid">
            <div class="card">
                <h3><?php echo $totalKategori; ?></h3>
                <p>Total Kategori</p>
                <a href="view/kategori.php">Kelola Kategori &rarr;</a>
            </div>
            <div class="card">
                <h3><?php echo $totalBarang; ?></h3>
                <p>Total Barang</p>
                <a href="view/barang.php">Kelola Barang &rarr;</a>
            </div>
            <div class="card">
                <h3><?php echo $totalPeminjaman; ?></h3>
                <p>Total Peminjaman</p>
                <a href="view/peminjaman.php">Kelola Peminjaman &rarr;</a>
            </div>
        </div>
    </div>
</body>
</html>
