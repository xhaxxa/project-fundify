const express = require('express'); 
const mysql = require('mysql2/promise'); 
const cors = require('cors'); 

const app = express();
const PORT = 3000; 

app.use(express.json());
app.use(cors());


const dbConfig = {
    host: 'localhost', 
    user: 'root',      
    password: '',      
    database: 'fundify_db' 
};

// Fungsi untuk mendapatkan koneksi database
async function getConnection() {
    try {
        const connection = await mysql.createConnection(dbConfig);
        console.log('Terhubung ke database MySQL.');
        return connection;
    } catch (error) {
        console.error('Koneksi database gagal:', error);
        process.exit(1);
    }
}

let db;
(async () => {
    db = await getConnection();
})();

//get data budget berdasarkan id user
app.get('/api/budgets/:user_id', async (req, res) => {
    const { user_id } = req.params; 

    try {
        const [rows] = await db.execute('SELECT * FROM budget WHERE user_id = ?', [user_id]);
        res.status(200).json(rows);
    } catch (error) {
        console.error('Error saat mendapatkan semua anggaran:', error);
        res.status(500).json({ message: 'Terjadi kesalahan saat mengambil anggaran.' });
    }
});

// get data budget berdasarkan id user dan id budget
app.get('/api/budgets/:user_id/:id', async (req, res) => {
    const { user_id, id } = req.params; 

    try {
        const [rows] = await db.execute('SELECT * FROM budget WHERE id = ? AND user_id = ?', [id, user_id]);
        res.status(200).json(rows[0] || null);
    } catch (error) {
        console.error('Error saat mendapatkan anggaran berdasarkan ID:', error);
        res.status(500).json({ message: 'Terjadi kesalahan saat mengambil anggaran.' });
    }
});

// memperbarui anggaran berdasarkan id user dan id budget
app.put('/api/budgets/:user_id/:id', async (req, res) => {
    const { user_id, id } = req.params; 
    const { deskripsi, jumlah } = req.body; 

    if (deskripsi === undefined || jumlah === undefined) {
        return res.status(400).json({ message: 'Deskripsi dan jumlah diperlukan.' });
    }

    try {
        const [result] = await db.execute(
            'UPDATE budget SET deskripsi = ?, jumlah = ? WHERE id = ? AND user_id = ?',
            [deskripsi, jumlah, id, user_id]
        );

        if (result.affectedRows === 0) {
            return res.status(404).json({ message: 'Anggaran tidak ditemukan atau bukan milik pengguna ini.' });
        }

        res.status(200).json({ message: 'Anggaran berhasil diperbarui.', success: true });
    } catch (error) {
        console.error('Error saat memperbarui anggaran:', error);
        res.status(500).json({ message: 'Terjadi kesalahan saat memperbarui anggaran.' });
    }
});

// membuat anggaran default untuk id user
app.post('/api/budgets/default/:user_id', async (req, res) => {
    const { user_id } = req.params; 

    const defaultBudgets = [
        { kategori: 'Belanja', deskripsi: 'Anggaran untuk kebutuhan belanja bulanan dan harian.', jumlah: 0 },
        { kategori: 'Hiburan', deskripsi: 'Anggaran untuk rekreasi, nonton, atau hobi.', jumlah: 0 },
        { kategori: 'Rumah', deskripsi: 'Anggaran untuk kebutuhan rumah tangga.', jumlah: 0 },
        { kategori: 'Pekerjaan', deskripsi: 'Anggaran untuk transportasi dan makan siang kerja.', jumlah: 0 }
    ];

    try {

        await db.beginTransaction();
        for (const budget of defaultBudgets) {
            await db.execute(
                'INSERT INTO budget (kategori, deskripsi, jumlah, user_id) VALUES (?, ?, ?, ?)',
                [budget.kategori, budget.deskripsi, budget.jumlah, user_id]
            );
        }
        await db.commit(); 

        res.status(201).json({ message: 'Anggaran default berhasil dibuat.', success: true });
    } catch (error) {
        await db.rollback(); 
        console.error('Error saat membuat anggaran default:', error);
        res.status(500).json({ message: 'Terjadi kesalahan saat membuat anggaran default.' });
    }
});

app.listen(PORT, () => {
    console.log(`Server berjalan di http://localhost:${PORT}`);
});
