<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Fundify</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center" style="min-height: 100vh;">
      <div class="col-md-5 align-self-center">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h3 class="text-center mb-4">Login ke Fundify</h3>
            <?php if(isset($_GET['status']) && $_GET['status'] == 'reg_success'): ?>
              <div class="alert alert-success">Registrasi berhasil! Silakan login.</div>
            <?php endif; ?>
            <?php if(isset($_GET['status']) && $_GET['status'] == 'login_failed'): ?>
              <div class="alert alert-danger">Username atau password salah.</div>
            <?php endif; ?>

            <form action="index.php?c=Auth&m=login" method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 text-center">Belum punya akun? <a href="index.php?c=Auth&m=register">Daftar sekarang</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>