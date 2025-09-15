<?php
session_start();

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Daftar akun yang diperbolehkan login
    $users = [
        'IT' => '234',
        'admin' => 'admin123',
        'zidni' => '234'
    ];

    // Ambil input user
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Cek apakah username ada dan password cocok
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['admin'] = true;
        header("Location: dashboard_admin.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
	<link rel="icon" type="image/png" href="1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eaeaea;
        }
        .login-box {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="login-box col-md-4">
        <h4 class="text-center mb-4">Login Admin</h4>

        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Login</button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="footer text-center text-white">
  <div class="container">
    <small>&copy; <?= date('Y') ?> zidnirifqi | Presensi Magang </small>
  </div>
</footer>
</body>
</html>
