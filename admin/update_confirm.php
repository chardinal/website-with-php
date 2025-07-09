<?php
require '../db_conection.php';

// Ambil data JSON dari request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['confirm'])) {
    $id = $data['id'];
    $confirm = $data['confirm'];

    // Query untuk memperbarui kolom confirm
    $query = "UPDATE pemesanan SET confirm = ? WHERE id_pemesanan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $confirm, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

$conn->close();
?>
