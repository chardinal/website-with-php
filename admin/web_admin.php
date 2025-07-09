<?php
require '../db_conection.php';

// Harga paket berdasarkan jenisnya
$package_prices = [
    "basic" => 2000000,
    "standard" => 4000000,
    "advanced" => 6000000,
    "mighty" => 8000000,
];

// Query untuk menghitung pendapatan secara keseluruhan
$queryEarnings = "SELECT package, COUNT(*) as total_orders FROM pemesanan GROUP BY package";
$resultEarnings = $conn->query($queryEarnings);

$total_earnings = 0;
$earnings_by_package = [];


// Hitung pendapatan berdasarkan paket
if ($resultEarnings) {
    while ($row = $resultEarnings->fetch_assoc()) {
        $package = $row['package'];
        $total_orders = (int)$row['total_orders'];

        $earning = $package_prices[$package] * $total_orders;
        $earnings_by_package[$package] = $earning;

        $total_earnings += $earning;
    }
}

// Query untuk mendapatkan total pesanan per kategori
$queryOrders = "SELECT tipe, COUNT(*) as total_orders FROM pemesanan GROUP BY tipe";
$resultOrders = $conn->query($queryOrders);

$categories = [];
$ordersData = [];

// Hitung total pesanan per kategori
if ($resultOrders) {
    while ($row = $resultOrders->fetch_assoc()) {
        $categories[] = $row['tipe'];
        $ordersData[] = (int)$row['total_orders'];
    }
}

// Tutup koneksi
$conn->close();

// Data untuk digunakan dalam grafik
$earnings_data = json_encode([
    "totalEarnings" => $total_earnings,
    "earningsByPackage" => $earnings_by_package
]);

$orders_data = json_encode([
    "categories" => $categories,
    "ordersData" => $ordersData
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- <link rel="stylesheet" href="css.admin/web_admin_style.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
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
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h2 {
            margin: 0;
            font-size: 1.8rem;
            text-align: center;
            color: #daa700;
            border-bottom: 2px solid #daa700;
            padding-bottom: 10px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 30px;
        }
        .sidebar ul li {
            margin: 15px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1.1rem;
            transition: color 0.3s ease;
            display: block;
            padding: 10px;
            border-radius: 4px;
        }
        .sidebar ul li a:hover {
            background-color: #daa700;
            color: #001021;
        }
        .main-content {
            margin-left: 290px;
            padding: 20px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .navbar input {
            width: 300px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .navbar .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #001021;
        }
        .earnings-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
            align-items: flex-start;
        }
        .earnings-section .chart,
        .earnings-section .card {
            flex: 1 1 45%;
            min-width: 300px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .earnings-section .chart canvas {
            max-width: 100%;
            height: auto;
        }
        .chart {
        background-color: #ffffff; /* Warna latar belakang putih */
        border: 1px solid #ddd; /* Tambahkan border tipis */
        border-radius: 8px; /* Membulatkan sudut */
        padding: 16px; /* Spasi dalam elemen */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan */
        margin: 16px 0; /* Jarak antar elemen vertikal */
        }

        .chart h3 {
            font-size: 1.5em; /* Ukuran font judul */
            color: #333; /* Warna teks judul */
            margin-bottom: 12px; /* Jarak bawah judul */
            font-weight: 600; /* Tebal font judul */
            text-align: center; /* Pusatkan teks judul */
        }

        #total-earnings {
            font-size: 2em; /* Ukuran font pendapatan */
            font-weight: bold; /* Tebal font pendapatan */
            color: #2a9d8f; /* Warna teks pendapatan hijau */
            text-align: center; /* Pusatkan teks */
            margin: 12px 0; /* Jarak atas dan bawah teks */
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 220px;
            }
            .navbar input {
                width: 200px;
            }
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
        <div class="chart">
            <h3>Total Pendapatan</h3>
            <p id="total-earnings"></p>
        </div>
    <div class="earnings-section">
        <div class="chart">
            <h3>Earnings by Package</h3>
            <canvas id="earningsChart"></canvas>
        </div>
        
        <div class="chart">
            <h3>Jumlah Pesanan per Kategori</h3>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // Data Pendapatan
        const earningsData = <?php echo $earnings_data; ?>;
        const earningsCtx = document.getElementById("earningsChart").getContext("2d");
        new Chart(earningsCtx, {
            type: 'pie',
            data: {
                labels: Object.keys(earningsData.earningsByPackage),
                datasets: [{
                    data: Object.values(earningsData.earningsByPackage),
                    backgroundColor: ['rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)', 'rgba(255, 206, 86, 0.7)', 'rgba(75, 192, 192, 0.7)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Pendapatan Berdasarkan Paket' }
                }
            }
        });
        // Tampilkan Total Pendapatan
        const totalEarningsElement = document.getElementById("total-earnings");
        totalEarningsElement.textContent = `Rp ${earningsData.totalEarnings.toLocaleString()}`;

        // Data Pesanan
        const ordersData = <?php echo $orders_data; ?>;
        const ordersCtx = document.getElementById("ordersChart").getContext("2d");
        new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: ordersData.categories,
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: ordersData.ordersData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    title: { display: true, text: 'Jumlah Pesanan per Kategori' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
</script>
</body>
</html>