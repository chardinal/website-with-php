<?php
include '../db_conection.php';
session_start();
    
    if (isset($_POST['login'])) {
            
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM login_admin WHERE email ='$email'";
        $query = mysqli_query($conn, $sql);
        $rows  = mysqli_num_rows($query);
        $assoc = mysqli_fetch_assoc($query);
        if ($rows > 0){
            if (hash('sha256', $password) == $assoc['password']) {
                $_SESSION['email'] = $assoc['email'];
                echo "<script>
                alert('Login Berhasil! Selamat datang!');
                window.location.href = 'web_admin.php'; </script>";
                exit;
            } else {
                echo "<script>
                alert('email atau Password Salah!');
                window.location.href = 'login.php'; </script>";
                exit;
            }
        } else {
                echo "<script>
                alert('email tidak ditemukan!');
                window.location.href = 'login.php'; </script>";
                exit;
        }
    }


if (isset($_POST['register'])) {
    // Ambil data dari form
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    // Validasi data
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required!');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Hash password dengan SHA-256
        $hashed_password = hash('sha256', $password);

        // Periksa apakah email sudah terdaftar
        $sql = "SELECT * FROM login_admin WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            echo "<script>alert('Email is already registered!');</script>";
        } else {
            // Masukkan data pengguna ke database
            $sql_insert = "INSERT INTO login_admin (nama, email, password) VALUES ('$name', '$email', '$hashed_password')";

            if (mysqli_query($conn, $sql_insert)) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "<script>alert('Registration failed! Please try again.');</script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="styles_login.css">
</head>
<body>
    <div class="container">
        <div class="logo-container">
            <img src="../img/logo+nama.png" alt="Admin Logo" class="logo">
        </div>
        <div class="form-container">
            <div class="form-header">
                <h2 id="form-title">Login</h2>
                <p id="form-toggle">Don't have an account? <span id="toggle-link">Register</span></p>
            </div>
            <form id="form" method="post" action="">
                <!-- Form Group for Name -->
                <div class="form-group" id="name-group" style="display: none;">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group" id="confirm-password-group" style="display: none;">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
                </div>
                <button type="submit" id="login-button" name="login">Login</button>
                <button type="submit" id="register-button" name="register" style="display: none;">Register</button>
            </form>
        </div>
    </div>

    <script>
        const formTitle = document.getElementById('form-title');
        const formToggle = document.getElementById('form-toggle');
        const nameGroup = document.getElementById('name-group');
        const confirmPasswordGroup = document.getElementById('confirm-password-group');
        const loginButton = document.getElementById('login-button');
        const registerButton = document.getElementById('register-button');

        formToggle.addEventListener('click', (event) => {
            if (event.target.id === 'toggle-link') {
                if (formTitle.textContent === 'Login') {
                    formTitle.textContent = 'Register';
                    formToggle.innerHTML = 'Already have an account? <span id="toggle-link">Login</span>';
                    nameGroup.style.display = 'block'; // Show Name Group
                    confirmPasswordGroup.style.display = 'block';
                    loginButton.style.display = 'none'; // Hide Login Button
                    registerButton.style.display = 'inline-block'; // Show Register Button
                } else {
                    formTitle.textContent = 'Login';
                    formToggle.innerHTML = 'Don\'t have an account? <span id="toggle-link">Register</span>';
                    nameGroup.style.display = 'none'; // Hide Name Group
                    confirmPasswordGroup.style.display = 'none';
                    loginButton.style.display = 'inline-block'; // Show Login Button
                    registerButton.style.display = 'none'; // Hide Register Button
                }
            }
        });
    </script>
</body>
</html>
