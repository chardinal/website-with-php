<?php
require '../db_conection.php';

$id = $_GET['id'];
$query = "DELETE FROM pemesanan WHERE id_pemesanan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: tabel_pemesanan.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}
?>