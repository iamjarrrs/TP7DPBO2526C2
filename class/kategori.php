<?php
require_once __DIR__ . '/../config/db.php';

class Kategori {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM kategori");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nama_kategori) {
        $stmt = $this->db->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
        return $stmt->execute([$nama_kategori]);
    }

    public function update($id, $nama_kategori) {
        $stmt = $this->db->prepare("UPDATE kategori SET nama_kategori = ? WHERE id = ?");
        return $stmt->execute([$nama_kategori, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM kategori WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
