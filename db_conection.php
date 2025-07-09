<?php
// Informasi Database
$server = "localhost";
$username = "root";
$password = "";
$database = "devsync"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($server, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>