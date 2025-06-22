<?php
class BudgetModel {
  private $conn;

  public function __construct() {
    $this->conn = new mysqli('localhost', 'root', '', 'fundify_db');
    if ($this->conn->connect_error) {
      die("Koneksi gagal: " . $this->conn->connect_error);
    }
  }

  public function getAll($user_id) {
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

  public function getById($id, $user_id) {
    $stmt = $this->conn->prepare("SELECT * FROM budget WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
    }

  public function update($id, $deskripsi, $jumlah, $user_id) {
    $stmt = $this->conn->prepare("UPDATE budget SET deskripsi = ?, jumlah = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("siii", $deskripsi, $jumlah, $id, $user_id);
    return $stmt->execute();
  }

  public function createDefaultBudgetsForUser($user_id) {
      $default_budgets = [
          ['kategori' => 'Belanja', 'deskripsi' => 'Anggaran untuk kebutuhan belanja bulanan dan harian.', 'jumlah' => 0, 'user_id' => $user_id],
          ['kategori' => 'Hiburan', 'deskripsi' => 'Anggaran untuk rekreasi, nonton, atau hobi.', 'jumlah' => 0, 'user_id' => $user_id],
          ['kategori' => 'Rumah', 'deskripsi' => 'Anggaran untuk kebutuhan rumah tangga.', 'jumlah' => 0, 'user_id' => $user_id],
          ['kategori' => 'Pekerjaan', 'deskripsi' => 'Anggaran untuk transportasi dan makan siang kerja.', 'jumlah' => 0, 'user_id' => $user_id]
      ];

      $stmt = $this->conn->prepare("INSERT INTO budget (kategori, deskripsi, jumlah, user_id) VALUES (?, ?, ?, ?)");

      foreach ($default_budgets as $budget) {
          $stmt->bind_param("ssii", $budget['kategori'], $budget['deskripsi'], $budget['jumlah'], $budget['user_id']);
          $stmt->execute();
      }

      return true;
  }
}
?>