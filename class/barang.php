<?php
require_once __DIR__ . '/../config/db.php';

class Barang {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT barang.*, kategori.nama_kategori FROM barang JOIN kategori ON barang.id_kategori = kategori.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_kategori, $nama_barang, $stok) {
        $stmt = $this->db->prepare("INSERT INTO barang (id_kategori, nama_barang, stok) VALUES (?, ?, ?)");
        return $stmt->execute([$id_kategori, $nama_barang, $stok]);
    }

    public function update($id, $id_kategori, $nama_barang, $stok) {
        $stmt = $this->db->prepare("UPDATE barang SET id_kategori = ?, nama_barang = ?, stok = ? WHERE id = ?");
        return $stmt->execute([$id_kategori, $nama_barang, $stok, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM barang WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
