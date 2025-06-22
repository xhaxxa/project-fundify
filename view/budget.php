<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fundify | Your Financial Management Solution</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
    <main class="flex-grow-1">
        <div class="container mt-5 pt-5">
            <h2 class="mb-4 text-center">Budgeting</h2>
            <div class="row">
                <?php foreach ($budget as $b): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <?php
                            $icons = [
                                'Belanja' => ['bi-cart-fill', 'text-primary'],
                                'Pekerjaan' => ['bi-briefcase-fill', 'text-warning'],
                                'Rumah' => ['bi-house-fill', 'text-success'],
                                'Hiburan' => ['bi-heart-fill', 'text-danger']
                            ];
                            $icon = $icons[$b['kategori']] ?? ['bi-folder-fill', 'text-secondary'];
                            ?>
                            <i class="bi <?= $icon[0] ?> fs-1 <?= $icon[1] ?> me-3"></i>
                            <h5 class="card-title mb-0"><?= htmlspecialchars($b['kategori']) ?></h5>
                        </div>
                        <a href="index.php?c=Budgeting&m=edit&id=<?= $b['id'] ?>" class="text-muted">✏️</a>
                        </div>
                        <p class="card-text"><?= htmlspecialchars($b['deskripsi']) ?></p>
                        <h4 class="card-budget">Rp <?= number_format($b['jumlah'], 0, ',', '.') ?></h4>
                        <a href="index.php?c=Transaksi&m=daftar&kategori=<?= urlencode($b['kategori']) ?>" class="btn btn-warning mt-3">Log Transaksi</a>
                    </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
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