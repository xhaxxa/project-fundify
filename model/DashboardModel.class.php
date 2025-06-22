<?php
class DashboardModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'fundify_db');

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getMonthlySummary($user_id) {
        $query = "SELECT 
                    MONTH(tanggal) AS bulan,
                    SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END) AS total_pemasukan,
                    SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END) AS total_pengeluaran
                  FROM transaksi
                  WHERE user_id = ?
                  GROUP BY MONTH(tanggal)
                  ORDER BY bulan";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getSaldoAkhir($user_id) {
        $query = "SELECT 
                SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END) -
                SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END) AS saldo 
            FROM transaksi
            WHERE user_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['saldo'] ?? 0;
    }

    public function getAllBudget($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM budget WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getTotalPengeluaranPerKategori($bulan, $tahun, $user_id) {
        $stmt = $this->conn->prepare("
            SELECT kategori, SUM(jumlah) AS total
            FROM transaksi
            WHERE jenis = 'pengeluaran' AND MONTH(tanggal) = ? AND YEAR(tanggal) = ? AND user_id = ?
            GROUP BY kategori
        ");
        $stmt->bind_param("iii", $bulan, $tahun, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[$row['kategori']] = $row['total'];
        }
        return $data;
    }
}
?>