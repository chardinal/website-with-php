<?php
require '../db_conection.php';
session_start(); // Mulai sesi

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        echo "<script>
            alert('Email dan password wajib diisi!');
            window.location.href = 'login.php';
        </script>";
        exit;
    }

    // Prepared statement untuk login
    $stmt = $conn->prepare("SELECT * FROM login_admin WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (hash('sha256', $password) === $user['password']) {
            $_SESSION['username'] = $user['username'];
            echo "<script>
                alert('Login Berhasil! Selamat datang!');
                window.location.href = 'web_admin.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Password salah!');
                window.location.href = 'login_admin.php';
            </script>";
            exit;
        }
    } else {
        echo "<script>
            alert('Username tidak ditemukan!');
            window.location.href = 'login_admin.php';
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="css.admin/admin_login_styles.css">
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="../img/logo+nama.png" alt="Admin Logo" class="logo">
        </div>
        <form class="login-form" action="process_login.php" method="POST">
            <h2>Login Admin</h2>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>

            <button type="submit" class="login-btn" name="login">Login</button>
            <button type="submit" class="login-btn" name="daftar" href>Daftar</button>

            <p class="forgot-password">
                <a href="register.php">Daftar Akun Baru</a>
            </p>
        </form>
    </div>
</body>
</html>
