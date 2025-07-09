<?php
require '../db_conection.php';

// Ambil data dari database
$query = "SELECT * FROM pemesanan";
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
    <link rel="stylesheet" href="css.admin/tabel_admin_style.css">
    <link rel="stylesheet" href="css.admin/web_admin_styles.css">
    <style>
        .confirmed {
            background-color:rgb(0, 0, 0); /* Hitam untuk menandai konfirmasi */
        }
    </style>
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
            <h1>Admin Panel - Data Pemesanan</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pemesanan</th>
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Paket</th>
                        <th>Tipe Aplikasi</th>
                        <th>Fitur</th>
                        <th>Pesan</th>
                        <th>Validasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = $result->fetch_assoc()) : ?>
                    <tr class="<?= $row['confirm'] ? 'confirmed' : '' ?>">
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['id_pemesanan']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['nik']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['telepon']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td><?= htmlspecialchars($row['package']) ?></td>
                        <td><?= htmlspecialchars($row['tipe']) ?></td>
                        <td><?= htmlspecialchars($row['features']) ?></td>
                        <td><?= htmlspecialchars($row['pesan']) ?></td>
                        <td>
                            <input type="checkbox" 
                                   class="confirm-checkbox" 
                                   data-id="<?= htmlspecialchars($row['id_pemesanan']) ?>" 
                                   <?= $row['confirm'] ? 'checked' : '' ?>>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= htmlspecialchars($row['id_pemesanan']) ?>" class="edit-button">Edit</a>
                            <a href="delete.php?id=<?= htmlspecialchars($row['id_pemesanan']) ?>" class="delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('.confirm-checkbox');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const id = this.dataset.id;
                    const isChecked = this.checked ? 1 : 0;

                    fetch('update_confirm.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ id: id, confirm: isChecked })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.closest('tr').classList.toggle('confirmed', isChecked);
                            alert('Status konfirmasi berhasil diperbarui!');
                        } else {
                            alert('Gagal memperbarui status konfirmasi!');
                            this.checked = !isChecked; // Kembalikan ke status sebelumnya
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                        this.checked = !isChecked; // Kembalikan ke status sebelumnya
                    });
                });
            });
        });
    </script>
</body>
</html>