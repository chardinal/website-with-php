<?php
include '../db_conection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css.admin/web_admin_styles.css">
    <style>
        /* About Us Section Styles */
        .content-section {
            background-color: #ffffff;
            color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        .content-section h2 {
            color: #4e73df;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }

        .content-section p {
            line-height: 1.6;
            font-size: 1rem;
            color: #555;
        }

        .edit-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #4e73df;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .edit-btn:hover {
            background-color: #375a7f;
            transform: scale(1.05);
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
        
        <!-- Ambil teks dari database -->
        <?php
        $sql = "SELECT * FROM captiom";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
        
        <div class="content-wrapper">
            <section id="aboutUs" class="content-section">
                <h2>About Us</h2>
                <!-- Menampilkan teks dari database -->
                <p><?= $row['conten'] ?></p>
                <!-- Tombol Edit -->
                <a href="edit_caption.php" class="edit-btn">Edit</a>
            </section>
        </div>
        
        <?php
        } else {
            echo "<p>No content available to display.</p>";
        }
        ?>
    </div>
</body>
</html>