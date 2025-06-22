const express = require("express");
const cors = require("cors");
const mysql = require("mysql2/promise");

const app = express();
const port = 8000;
app.use(cors());
app.use(express.json());

const dbConfig = {
  host: "localhost",
  user: "root",
  password: "",
  database: "fundify_db"
};


// Insert transaksi
app.post("/transaksi", async (req, res) => {
  const { jumlah, jenis, kategori, tanggal, deskripsi, user_id } = req.body;

  try {
    const db = await mysql.createConnection(dbConfig);
    const sql = `
      INSERT INTO transaksi (jumlah, jenis, kategori, tanggal, deskripsi, user_id)
      VALUES (?, ?, ?, ?, ?, ?)
    `;
    await db.execute(sql, [jumlah, jenis, kategori, tanggal, deskripsi, user_id]);
    db.end();

    res.status(200).json({ message: "Berhasil" });
  } catch (error) {
    res.status(500).json({ message: "Gagal", error: error.message });
  }
});

// Ambil semua transaksi user
app.get("/transaksi/user/:user_id", async (req, res) => {
  const user_id = parseInt(req.params.user_id);

  try {
    const db = await mysql.createConnection(dbConfig);
    const sql = "SELECT * FROM transaksi WHERE user_id = ? ORDER BY tanggal DESC";
    const [rows] = await db.execute(sql, [user_id]);
    db.end();

    res.status(200).json(rows);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Ambil transaksi by id + user
app.get("/transaksi/:id/user/:user_id", async (req, res) => {
  const id = parseInt(req.params.id);
  const user_id = parseInt(req.params.user_id);

  try {
    const db = await mysql.createConnection(dbConfig);
    const sql = "SELECT * FROM transaksi WHERE id = ? AND user_id = ?";
    const [rows] = await db.execute(sql, [id, user_id]);
    db.end();

    if (rows.length > 0) {
      res.status(200).json(rows[0]);
    } else {
      res.status(404).json({ message: "Transaksi tidak ditemukan." });
    }
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Update transaksi
app.put("/transaksi/:id", async (req, res) => {
  const id = parseInt(req.params.id);
  const { jumlah, jenis, kategori, tanggal, deskripsi, user_id } = req.body;

  try {
    const db = await mysql.createConnection(dbConfig);
    const sql = `
      UPDATE transaksi 
      SET jumlah = ?, jenis = ?, kategori = ?, tanggal = ?, deskripsi = ?
      WHERE id = ? AND user_id = ?
    `;
    const [result] = await db.execute(sql, [jumlah, jenis, kategori, tanggal, deskripsi, id, user_id]);
    db.end();

    if (result.affectedRows > 0) {
      res.status(200).json({ message: "Transaksi berhasil diperbarui." });
    } else {
      res.status(404).json({ message: "Transaksi tidak ditemukan." });
    }
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Delete transaksi
app.delete("/transaksi/:id/user/:user_id", async (req, res) => {
  const id = parseInt(req.params.id);
  const user_id = parseInt(req.params.user_id);

  try {
    const db = await mysql.createConnection(dbConfig);
    const sql = "DELETE FROM transaksi WHERE id = ? AND user_id = ?";
    const [result] = await db.execute(sql, [id, user_id]);
    db.end();

    if (result.affectedRows > 0) {
      res.status(200).json({ message: "Transaksi berhasil dihapus." });
    } else {
      res.status(404).json({ message: "Transaksi tidak ditemukan." });
    }
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});


app.listen(port, () => {
  console.log("App is running at port: " + port);
});