<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pencatatan Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="z-index: 1060;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                Fundify
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/projectPWeb/index.php?c=Dashboard&m=index">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/projectPWeb/index.php?c=Transaksi&m=form">Pencatatan Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/projectPWeb/index.php?c=Budgeting&m=index">Budgeting</a>
                    </li>
                </ul>
                <a href="index.php?c=Auth&m=logout" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
  <main class="flex-grow-1">
    <div class="container mt-5 pt-5">
      <h2 class="mb-4 text-center">Pencatatan Transaksi</h2>
      <form action="index.php?c=Transaksi&m=insert" method="POST">
        <div class="mb-3">
          <label for="jumlah" class="form-label">Jumlah</label>
          <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
          <label for="jenis" class="form-label">Jenis</label>
          <select class="form-select" id="jenis" name="jenis" required>
            <option value="">-- Pilih Jenis --</option>
            <option value="pemasukan">Pemasukan</option>
            <option value="pengeluaran">Pengeluaran</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="kategori" class="form-label">Kategori</label>
          <select class="form-select" id="kategori" name="kategori" onchange="toggleKategoriBaru(this)" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="Belanja">Belanja</option>
            <option value="Pekerjaan">Pekerjaan</option>
            <option value="Rumah">Rumah</option>
            <option value="Hiburan">Hiburan</option>
          </select>
        </div>
        <div class="mb-3" id="kategoriBaruGroup" style="display: none;">
          <label for="kategoriBaru" class="form-label">Kategori Baru</label>
          <input type="text" class="form-control" id="kategoriBaru" name="kategoriBaru">
        </div>
        <div class="mb-3">
          <label for="tanggal" class="form-label">Tanggal</label>
          <input type="date" class="form-control" id="tanggal" name="tanggal" required>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
      </form>
    </div>
  </main>
  <footer class="bg-dark text-white mt-5 pt-4 pb-4 text-left">
        <div class="container">
            <img src="logo.png" alt="Logo" width="30" height="30" class="mb-3">
            <p class="mb-1">© 2025 Fundify. All Rights Reserved.</p>
            <p class="mb-1">Privacy Policy | Terms of Service</p>
            <p class="mb-1">Contact us: support@fundify.com</p>
            <p class="mb-1">Follow us on:</p>
            <div>
                <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
  </footer>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>