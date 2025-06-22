<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
  <div class="container mt-5 pt-4">
    <h2 class="mb-4 text-center">Daftar Seluruh Transaksi</h2>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Jumlah</th>
          <th>Jenis</th>
          <th>Kategori</th>
          <th>Tanggal</th>
          <th>Deskripsi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($transaksi)) : ?>
          <?php foreach ($transaksi as $i => $t) : ?>
            <tr>
              <td><?= $i + 1 ?></td>
              <td>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></td>
              <td><?= ucfirst($t['jenis']) ?></td>
              <td><?= htmlspecialchars($t['kategori']) ?></td>
              <td><?= $t['tanggal'] ?></td>
              <td><?= htmlspecialchars($t['deskripsi']) ?></td>
            </tr>
          <?php endforeach ?>
        <?php else : ?>
          <tr>
            <td colspan="6" class="text-center">Belum ada data transaksi.</td>
          </tr>
        <?php endif ?>
      </tbody>
    </table>

    <div class="text-center mt-4">
      <a href="index.php?c=Transaksi&m=form" class="btn btn-primary">+ Tambah Transaksi</a>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
