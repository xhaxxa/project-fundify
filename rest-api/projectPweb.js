const express = require("express");
const cors = require("cors");
const mysql = require("mysql2/promise");

const app = express();
const router = express.Router();
const port = 8000;

app.use(cors());
app.use(express.json());


const insertTransaksi = async (req, res) => {
    const { jumlah, jenis, kategori, tanggal, deskripsi } 
    = req.body;

    if (!jumlah || !jenis || !kategori || !tanggal || !deskripsi) {
        return res.status(400).json({ success: false, message: "Data tidak lengkap" });
    }

    try {
        const db = await mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'fundify_db' 
        });

        const sql =
            "INSERT INTO transaksi " + "(jumlah, jenis, kategori, tanggal, deskripsi)" 
            + " VALUES (?, ?, ?, ?, ?)";

        const result = await db.execute(sql, [jumlah, jenis, kategori, tanggal, deskripsi]);
        db.end();

      res.status(200).json({message: "Berhasil"});
    } catch (error) {
      res.status(409).json({error});
    }
};

router.post("/transaksi", insertTransaksi);

app.use("/", router);

app.listen(port, () => {
    console.log("App is running at port: " + port);
});

