<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaksi Berhasil</title>
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
  <div class="container text-center mt-5 pt-4">
    <div class="alert alert-success">
      <h4 class="alert-heading">Transaksi Berhasil!</h4>
      <p>Data transaksi Anda telah berhasil disimpan ke sistem.</p>
      <hr>
      <a href="index.php?c=Transaksi&m=form" class="btn btn-outline-primary">Tambah Transaksi Lagi</a>
      <a href="index.php?c=Dashboard&m=index" class="btn btn-success">Lihat Dashboard</a>
    </div>
  </div>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
