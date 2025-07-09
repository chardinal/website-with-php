<?php
require '../db_conection.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id = $_GET['id'];
$query = "SELECT * FROM pemesanan WHERE id_pemesanan = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = htmlspecialchars($_POST['nama']);
    $nik = htmlspecialchars($_POST['nik']);
    // Ambil data lainnya...

    $updateQuery = "UPDATE pemesanan SET nama = ?, nik = ? WHERE id_pemesanan = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssi", $nama, $nik, $id);

    if ($stmt->execute()) {
        echo "<script>
        alert('Data berhasil diperbarui!'); window.location.href = 'tabel_pemesanan.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="css.admin/admin_edit.css">

</head>
<body>
<form method="POST">
    <h2>Form Pemesanan</h2>

    <div class="form-section">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <label for="nik">NIK:</label>
        <input type="text" id="nik" name="nik" value="<?= htmlspecialchars($data['nik']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
    </div>

    <div class="form-section">
        <label for="telepon">Nomor Telepon:</label>
        <input type="text" id="telepon" name="telepon" value="<?= htmlspecialchars($data['telepon']) ?>" required>

        <label for="alamat">Alamat Lengkap:</label>
        <textarea id="alamat" name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
    </div>

    <div class="form-section">
        <label for="package">Paket:</label>
        <select id="package" name="package" required>
            <option value="BASIC" <?= $data['package'] === 'BASIC' ? 'selected' : '' ?>>BASIC</option>
            <option value="STANDARD" <?= $data['package'] === 'STANDARD' ? 'selected' : '' ?>>STANDARD</option>
            <option value="PREMIUM" <?= $data['package'] === 'PREMIUM' ? 'selected' : '' ?>>PREMIUM</option>
            <option value="MIGHTY" <?= $data['package'] === 'MIGHTY' ? 'selected' : '' ?>>MIGHTY</option>
        </select>

        <label for="tipe">Tipe Aplikasi Mobile:</label>
        <input type="text" id="tipe" name="tipe" value="<?= htmlspecialchars($data['tipe']) ?>" required>
    </div>

    <div class="form-section">
        <label for="features">Fitur Dalam Aplikasi:</label>
        <textarea id="features" name="features" required><?= htmlspecialchars($data['features']) ?></textarea>

        <label for="pesan">Pesan Tambahan:</label>
        <textarea id="pesan" name="pesan"><?= htmlspecialchars($data['pesan']) ?></textarea>
    </div>

    <button type="submit">Simpan</button>
</form>
</body>
</html>