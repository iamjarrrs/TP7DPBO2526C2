<?php
require_once __DIR__ . '/../config/db.php';

class Peminjam {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT peminjaman.*, barang.nama_barang FROM peminjaman JOIN barang ON peminjaman.id_barang = barang.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM peminjaman WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($id_barang, $nama_peminjam, $jumlah_pinjam, $status) {
        $stmt = $this->db->prepare("INSERT INTO peminjaman (id_barang, nama_peminjam, jumlah_pinjam, status) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id_barang, $nama_peminjam, $jumlah_pinjam, $status]);
    }

    public function update($id, $id_barang, $nama_peminjam, $jumlah_pinjam, $status) {
        $stmt = $this->db->prepare("UPDATE peminjaman SET id_barang = ?, nama_peminjam = ?, jumlah_pinjam = ?, status = ? WHERE id = ?");
        return $stmt->execute([$id_barang, $nama_peminjam, $jumlah_pinjam, $status, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM peminjaman WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
