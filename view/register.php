<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Fundify</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container">
    <div class="row justify-content-center" style="min-height: 100vh;">
      <div class="col-md-5 align-self-center">
        <div class="card shadow-sm">
          <div class="card-body p-4">
            <h3 class="text-center mb-4">Buat Akun Fundify</h3>
            <form action="index.php?c=Auth&m=register" method="POST">
              <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="mt-3 text-center">Sudah punya akun? <a href="index.php?c=Auth&m=login">Login di sini</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>