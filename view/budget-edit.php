<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Kategori</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container mt-5 pt-4">
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
                        <a class="nav-link" href="http://localhost/projectPWeb/index.php?c=Transaksi&m=form">Pencatatan Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="http://localhost/projectPWeb/index.php?c=Budgeting&m=index">Budgeting</a>
                    </li>
                </ul>
                <a href="index.php?c=Auth&m=logout" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    <h2>Edit Kategori: <?= $budget['kategori'] ?></h2>
    <?php if (!$budget): ?>
    <div class="alert alert-danger mt-4">
        Data kategori tidak ditemukan.
    </div>
    <a href="index.php?c=Budgeting&m=index" class="btn btn-secondary">Kembali</a>
    <?php else: ?>
    <form action="index.php?c=Budgeting&m=update" method="POST">
        <input type="hidden" name="id" value="<?= $budget['id'] ?>">

        <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" required><?= $budget['deskripsi'] ?></textarea>
        </div>

        <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah Anggaran (Rp)</label>
        <input type="number" name="jumlah" class="form-control" value="<?= $budget['jumlah'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php?c=Budgeting&m=index" class="btn btn-secondary">Batal</a>
    </form>
    <?php endif; ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>