<?php
require '../db_conection.php';

// Ambil data dari database
$query = "SELECT * FROM customer_services";
$result = $conn->query($query);

if (!$result) {
    die("Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Data Pemesanan</title>
    <link rel="stylesheet" href="css.admin/web_admin_styles.css">
    <link rel="stylesheet" href="css.admin/tabel_admin_style.css">
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
        
        <!-- Kontainer Tabel -->
        <div class="container">
            <h1>Admin Panel - Nomor Customer Services</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N0 WHATSAPP</th>
                        <th>NAMA</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id_cs']) ?></td>
                        <td><?= htmlspecialchars($row['no_whatsapp']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td>
                            <a href="edit_cs.php?id=<?= htmlspecialchars($row['id_cs']) ?>" class="edit-button">Edit</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>