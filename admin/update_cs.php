<?php
require '../db_conection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cs = intval($_POST['id_cs']);
    $no_whatsapp = $_POST['no_whatsapp'];
    $nama = $_POST['nama'];

    // Validasi input (opsional: tambahkan validasi lebih ketat jika diperlukan)
    if (empty($no_whatsapp) || empty($nama)) {
        die("Semua kolom harus diisi!");
    }

    // Update data ke database
    $query = "UPDATE customer_services SET no_whatsapp = ?, nama = ? WHERE id_cs = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $no_whatsapp, $nama, $id_cs);

    if ($stmt->execute()) {
        // Redirect ke halaman utama
        header("Location: customer_services.php");
        exit;
    } else {
        die("Error: " . $stmt->error);
    }
} else {
    die("Metode tidak valid!");
}
?>