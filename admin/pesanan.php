<?php
require '../db_conection.php';

// Query untuk mendapatkan total pesanan per kategori
$query = "SELECT tipe, COUNT(*) as total_orders FROM pemesanan GROUP BY tipe";
$result = $conn->query($query);

$categories = [];
$ordersData = [];

// Hitung total pesanan per kategori
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['tipe'];
        $ordersData[] = (int)$row['total_orders'];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css.admin/web_admin_styles.css">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .sidebar {
            width: 250px;
            background-color: #001021;
            color: white;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            overflow: auto;
        }
        .sidebar h2 {
            margin: 0;
            font-size: 1.5rem;
            text-align: center;
            color: #fff;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        .sidebar ul li {
            margin: 20px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #daa700;
            transition: color 0.3s ease;
        }
        .sidebar ul li a:hover {
            color: #fff;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        .chart {
            background-color: #fff;
            margin: 30px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
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
            <li><a href="contact_us.php">Contact Us</a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="navbar">
            <input type="text" placeholder="Search for..." />
            <div class="profile">
                <span>Admin</span>
                <img src="profile.jpg" alt="Profile">
            </div>
        </div>
    <div class="main-content">
        <div class="chart">
            <h3>Jumlah Pesanan per Kategori</h3>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const ordersChartCtx = document.getElementById("ordersChart").getContext("2d");

            // Data dari PHP
            const categories = <?php echo json_encode($categories); ?>;
            const ordersData = <?php echo json_encode($ordersData); ?>;

            // Grafik jumlah pesanan per kategori
            new Chart(ordersChartCtx, {
                type: 'bar',
                data: {
                    labels: categories,
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: ordersData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Pesanan per Kategori'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
