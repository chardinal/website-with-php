<?php
// Pastikan Anda menggunakan koneksi database
include '../db_conection.php';

// Ambil data dari database
$sql = "SELECT * FROM paket_layanan";
$result = $conn->query($sql);

if (!$result) {
    die("Error dalam query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DaFtar Paket Layanan</title>
    <link rel="stylesheet" href="css.admin/style_pilihan.css">
    <link rel="stylesheet" href="css.admin/web_admin_styles.css">
    
</head>
<body>
<div class="sidebar">
        <h2>DevSync Admin</h2>
        <ul>
            <li><a href="web_admin.php">Dashboard</a></li>
            <li><a href="tabel_pemesanan.php">Tabel Pemesanan</a></li> 
            <li><a href="packages.php">Paket Layanan</a></li>
            <li><a href="customer_services.php">Customer Services</a></li>
            <li><a href="caption.php">Caption</a></li>
            <li><a href="porto.php">Portofolio</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="navbar">
            <input type="text" placeholder="Search for..." />
            <div class="profile">
                <span>Admin</span>
                <img src="../img/user_avatar.png" alt="Profile">
            </div>
        </div>

    <!-- Tampilkan tabel data -->
    <table border ="1">
    <h1>Admin Panel - Paket Layanan</h1>
    <style>
        h1{
            background :#1a1a1a;
            padding :12px;
            border-radius :10px;
            text-align: center;
            }
        .edit-button{
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            }
        .edit-button {
            background-color: #007bff; /* Biru */
        }
    </style>
        <thead>
            <tr>
                <th>ID Paket</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Fitur</th>
                <th>Durasi Pengerjaan</th>
                <th>Jumlah Revisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Looping untuk menampilkan data
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['id_paket']; ?></td>
                        <td><?php echo $row['nama_paket']; ?></td>
                        <td><?php echo $row['harga']; ?></td>
                        <td><?php echo $row['fitur']; ?></td>
                        <td><?php echo $row['durasi_pengerjaan']; ?></td>
                        <td><?php echo $row['jumlah_revisi']; ?></td>
                        <td>
                            <a href="edit_paket.php?id_paket=<?php echo $row['id_paket']; ?>" class="edit-button">Edit</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7'>Tidak ada data ditemukan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Tutup koneksi database
$conn->close();
?>