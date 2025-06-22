<?php
class TransaksiModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'fundify_db');

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function insert($jumlah, $jenis, $kategori, $tanggal, $deskripsi, $user_id) {
        $stmt = $this->conn->prepare("INSERT INTO transaksi (jumlah, jenis, kategori, tanggal, deskripsi, user_id) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssi", $jumlah, $jenis, $kategori, $tanggal, $deskripsi, $user_id);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Gagal menyimpan transaksi: " . $stmt->error);
        }
    }

    public function getAll($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM transaksi WHERE user_id = ? ORDER BY tanggal DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        return $data;
    }

    public function getById($id, $user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM transaksi WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $jumlah, $jenis, $kategori, $tanggal, $deskripsi, $user_id) {
        $stmt = $this->conn->prepare("UPDATE transaksi SET jumlah=?, jenis=?, kategori=?, tanggal=?, deskripsi=? WHERE id=? AND user_id = ?");
        $stmt->bind_param("sssssii", $jumlah, $jenis, $kategori, $tanggal, $deskripsi, $id, $user_id);
        return $stmt->execute();
    }

    public function delete($id, $user_id) {
        $stmt = $this->conn->prepare("DELETE FROM transaksi WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $user_id);
        return $stmt->execute();
    }
}
?>