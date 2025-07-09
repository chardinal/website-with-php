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
$query = "SELECT package, COUNT(*) as total_orders FROM pemesanan GROUP BY package";
$result = $conn->query($query);

$total_earnings = 0;
$earnings_by_package = [];

// Hitung pendapatan berdasarkan paket
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $package = $row['package'];
        $total_orders = (int)$row['total_orders'];

        $earning = $package_prices[$package] * $total_orders;
        $earnings_by_package[$package] = $earning;

        $total_earnings += $earning;
    }
}

// Tutup koneksi
$conn->close();

// Kembalikan data dalam format JSON
$earnings_data = json_encode([
    "totalEarnings" => $total_earnings,
    "earningsByPackage" => $earnings_by_package,
    "packagePrices" => $package_prices // Menyertakan harga paket dalam JSON
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earnings Dashboard</title>
    <link rel="stylesheet" href="css.admin/web_admin_styles.css">
</head>
<body>
<div class="sidebar">
        <h2>DevSync Admin</h2>
        <ul>
            <li><a href="web_admin.php">Dashboard</a></li>
            <li><a href="tabel_pemesanan.php">Tabel Pemesanan</a></li> 
            <li><a href="pesanan.php">Pesanan</a></li>
            <li><a href="pendapatan.php">Pendapatan</a></li>
            <li><a href="customer_services.php">Cusomer Services</a></li>
            <li><a href="caption.php">Caption</a></li>
            <li><a href="porto.php">Portfolio</a></li>
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
        <div class="dashboard">
            <div class="card" id="total-earnings">
                <h3>Total Earnings</h3>
                <p id="total-earnings-value">Loading...</p>
            </div>
        </div>
        <div class="charts">
            <div class="chart">
                <h3>Earnings by Package</h3>
                <canvas id="earningsChart"></canvas>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Ambil data dari PHP
        const earningsData = <?php echo $earnings_data; ?>;
        const totalEarnings = earningsData.totalEarnings;
        const earningsByPackage = earningsData.earningsByPackage;
        const packagePrices = earningsData.packagePrices;

        // Tampilkan total pendapatan
        document.getElementById('total-earnings-value').textContent = `Rp ${totalEarnings.toLocaleString()}`;

        // Data untuk grafik pendapatan per paket
        const labels = Object.keys(earningsByPackage);
        const dataValues = Object.values(earningsByPackage);

        // Fungsi untuk menghitung total pendapatan berdasarkan harga paket
        let calculatedTotal = 0;
        labels.forEach(label => {
            // Mengambil total order dan harga per paket
            const totalOrders = earningsByPackage[label] / packagePrices[label];
            const packagePrice = packagePrices[label];

            // Menghitung pendapatan
            calculatedTotal += totalOrders * packagePrice;
        });

        console.log("Calculated Total Earnings: ", calculatedTotal); // Menampilkan pendapatan yang dihitung dengan cara lain (opsional)

        // Grafik pendapatan per paket
        const ctx = document.getElementById('earningsChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan per Paket',
                    data: dataValues,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
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
                        text: 'Pendapatan per Paket'
                    }
                }
            }
        });
    });
</script>
</html>
