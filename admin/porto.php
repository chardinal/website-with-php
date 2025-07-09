<?php
// Informasi Database
require '../db_conection.php';
// Nama database Anda

// Membuat koneksi
$conn = new mysqli($server, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Handle penghapusan gambar
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM porto WHERE id_porto=$id"; // Tabel sesuai dengan nama tabel Anda
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Gambar berhasil di hapus')</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil semua gambar dari database
$sql = "SELECT * FROM porto"; // Sesuaikan nama tabel jika berbeda
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio </title>
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

        <style>
        /* Gaya CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color:rgb(0, 0, 0);
            margin-top: 20px;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color:rgb(0, 0, 52);
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-add {
            background-color: #4CAF50;
        }

        .btn-add:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #e74c3c;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }
    </style>
    <script>
        // Fungsi untuk menampilkan pesan pop-up
        function showMessage(message) {
            if (message) {
                alert(message);
            }
        }
    </script>
</head>
<body onload="showMessage('<?php echo $message; ?>')">

<h1>Portofolio Gambar</h1>

<!-- Tabel daftar gambar -->
<table>
    <tr>
        <th>ID</th>
        <th>Kategori</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id_porto']; ?></td>
        <td><?php echo $row['kategori']; ?></td>
        <td><img src="<?php echo $row['gambar']; ?>" alt="Image" width="100"></td>
        <td>
            <a href="?delete=<?php echo $row['id_porto']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')" class="btn btn-delete">Delete</a>
            <a href="add_porto.php" class="btn btn-add">Add</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

<?php
$conn->close();
?>