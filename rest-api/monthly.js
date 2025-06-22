const express = require('express');
const mysql = require('mysql2/promise');
const app = express();
const port = 8000;

const dbConfig = {
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'fundify_db'
};

app.use(express.json());

const getMonthlySummary = async (req, res) => {
    try {
        const { userId } = req.params;

        const connection = await mysql.createConnection(dbConfig);

        const sql = `
            SELECT 
                MONTH(tanggal) AS bulan,
                SUM(CASE WHEN jenis = 'pemasukan' THEN jumlah ELSE 0 END) AS total_pemasukan,
                SUM(CASE WHEN jenis = 'pengeluaran' THEN jumlah ELSE 0 END) AS total_pengeluaran
            FROM transaksi
            WHERE user_id = ?
            GROUP BY MONTH(tanggal)
            ORDER BY bulan;
        `; 

        const [results] = await connection.execute(sql, [userId]);
        
        await connection.end();
        
        res.status(200).json(results); 

    } catch (error) {
        res.status(500).json({ message: 'Server error', error: error.message });
    }
};

const router = express.Router();
router.get('/summary/monthly/:userId', getMonthlySummary); //
app.use('/api', router); //

app.listen(port, () => {
    console.log("App is running at port:" + port);
});