<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fundify | Your Financial Management Solution</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
                        <a class="nav-link active"  aria-current="page" href="http://localhost/projectPWeb/index.php?c=Dashboard&m=index">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/projectPWeb/index.php?c=Transaksi&m=form">Pencatatan Transaksi</a>
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
        <div class="text-start">
            <h1>Hi, Fundifriends!</h1>
            <p class="text-muted fs-4">Ada transaksi apa hari ini?</p>
        </div>
    </div>
    <div style="position: fixed; top: 70px; right: 20px; z-index: 1050;">
        <button class="btn btn-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 24px; line-height: 1" onclick="window.location.href='index.php?c=Transaksi&m=form'">
            +
        </button>
    </div>
    <div class="container mt-5">
        <h2 class="text-center">Grafik Perkembangan</h2>
        <canvas id="incomeExpenseChart" width="400" height="200"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const bulanLabels = <?= json_encode(array_map(fn($d) => date('F', mktime(0, 0, 0, $d['bulan'], 1)), $summary)) ?>;
        const pemasukanData = <?= json_encode(array_map(fn($d) => (int)$d['total_pemasukan'], $summary)) ?>;
        const pengeluaranData = <?= json_encode(array_map(fn($d) => (int)$d['total_pengeluaran'], $summary)) ?>;

        const ctx = document.getElementById('incomeExpenseChart').getContext('2d');
        const incomeExpenseChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: bulanLabels,
            datasets: [
                {
                label: 'Pendapatan',
                data: pemasukanData,
                borderColor: 'blue',
                backgroundColor: 'rgba(0, 0, 255, 0.1)',
                fill: true,
                },
                {
                label: 'Pengeluaran',
                data: pengeluaranData,
                borderColor: 'red',
                backgroundColor: 'rgba(255, 0, 0, 0.1)',
                fill: true,
                }
            ]
            },
            options: {
            responsive: true,
            plugins: {
            legend: {
                display: true,
                position: 'bottom'
                }
            },
            scales: {
                x: {
                title: { display: true, text: 'Bulan' }
                },
                y: {
                title: { display: true, text: 'Jumlah (Rp)' }
                }
            }
            }
        });
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <div class="container mt-4">
        <div class="card text-center shadow-lg border-0" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-radius: 15px;">
            <div class="card-body">
                <h5 class="card-title">Your Balance</h5>
                <p class="card-text fs-4 fw-bold">Rp <?= number_format($saldo, 0, ',', '.') ?></p>
            </div>
        </div>
    </div>
    <<div class="container mt-5">
        <div class="row">
            <?php
            $icons = [
            'Belanja' => ['bi-cart-fill', 'text-primary'],
            'Pekerjaan' => ['bi-briefcase-fill', 'text-warning'],
            'Rumah' => ['bi-house-fill', 'text-success'],
            'Hiburan' => ['bi-heart-fill', 'text-danger'],
            ];

            $left = array_filter($budget, fn($b) => in_array($b['kategori'], ['Belanja', 'Rumah']));
            $right = array_filter($budget, fn($b) => in_array($b['kategori'], ['Pekerjaan', 'Hiburan']));
            ?>

            <div class="col-md-6">
            <?php foreach ($left as $b): ?>
                <?php
                $kategori = $b['kategori'];
                $limit = $b['jumlah'];
                $terpakai = $pengeluaran[$kategori] ?? 0;
                $persen = $limit > 0 ? ($terpakai / $limit) * 100 : 0;

                if ($persen <= 70) {
                    $warna = 'text-success';
                } elseif ($persen <= 100) {
                    $warna = 'text-warning';
                } else {
                    $warna = 'text-danger fw-bold';
                }

                $icon = $icons[$kategori] ?? ['bi-folder-fill', 'text-secondary'];
                ?>
                <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="bi <?= $icon[0] ?> fs-1 <?= $icon[1] ?> me-3"></i>
                    <div>
                    <h5 class="card-title mb-1"><?= htmlspecialchars($kategori) ?></h5>
                    <p class="card-text <?= $warna ?>">
                        Rp <?= number_format($terpakai, 0, ',', '.') ?> /
                        <strong>Rp <?= number_format($limit, 0, ',', '.') ?></strong>
                    </p>
                    </div>
                </div>
                </div>
            <?php endforeach; ?>
            </div>

            <div class="col-md-6">
            <?php foreach ($right as $b): ?>
                <?php
                $kategori = $b['kategori'];
                $limit = $b['jumlah'];
                $terpakai = $pengeluaran[$kategori] ?? 0;
                $persen = $limit > 0 ? ($terpakai / $limit) * 100 : 0;

                if ($persen <= 70) {
                    $warna = 'text-success';
                } elseif ($persen <= 100) {
                    $warna = 'text-warning';
                } else {
                    $warna = 'text-danger fw-bold';
                }

                $icon = $icons[$kategori] ?? ['bi-folder-fill', 'text-secondary'];
                ?>
                <div class="card mb-3 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <i class="bi <?= $icon[0] ?> fs-1 <?= $icon[1] ?> me-3"></i>
                    <div>
                    <h5 class="card-title mb-1"><?= htmlspecialchars($kategori) ?></h5>
                    <p class="card-text <?= $warna ?>">
                        Rp <?= number_format($terpakai, 0, ',', '.') ?> /
                        <strong>Rp <?= number_format($limit, 0, ',', '.') ?></strong>
                    </p>
                    </div>
                </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
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