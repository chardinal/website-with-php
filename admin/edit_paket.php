<?php
// Koneksi database
include '../db_conection.php';

// Cek apakah ID Paket tersedia di URL
if (isset($_GET['id_paket'])) {
    $id_paket = $_GET['id_paket'];

    // Ambil data berdasarkan ID
    $sql = "SELECT * FROM paket_layanan WHERE id_paket = $id_paket";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc(); // Ambil data yang sesuai dengan ID
    } else {
        die("Data tidak ditemukan.");
    }
} else {
    die("ID Paket tidak ditemukan.");
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_paket = $_POST['nama_paket'];
    $harga = $_POST['harga'];
    $fitur = $_POST['fitur'];
    $durasi_pengerjaan = $_POST['durasi_pengerjaan'];
    $jumlah_revisi = $_POST['jumlah_revisi'];

    // Update data ke database
    $update_sql = "UPDATE paket_layanan 
                   SET nama_paket = '$nama_paket', 
                       harga = $harga, 
                       fitur = '$fitur', 
                       durasi_pengerjaan = $durasi_pengerjaan, 
                       jumlah_revisi = $jumlah_revisi 
                   WHERE id_paket = $id_paket";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui.');</script>";
        header("Location: packages.php"); // Redirect kembali ke halaman utama
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Paket Layanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #1a1a1a; /* Background hitam */
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            width: 92%;
            background: #000000;
            text-align: center;
            font-size: 35px;
            margin-bottom: 20px;
            color: #ffdd00;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 40px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }

        form {
            max-width: 600px; /* Memperpanjang lebar form */
            margin: 0 auto;
            background-color:rgb(0, 23, 48);
            padding: 40px; /* Mengurangi padding untuk tampilan lebih kompak */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        form label {
            font-size: 1rem;
            margin-bottom: 5px;
            display: block;
            color: #ffdd00;
        }

        form input[type="text"], 
        form input[type="number"], 
        form textarea {
            width: calc(100% - 22px); /* Memperpanjang kolom pengisian */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #fff;
            color: #000000;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        form input[type="text"]:focus, 
        form input[type="number"]:focus, 
        form textarea:focus {
            border-color: #007bff; /* Warna border saat fokus */
            outline: none; /* Menghilangkan outline default */
        }

        form textarea {
            height: 100px; /* Memperpanjang tinggi textarea */
            resize: none;
        }

        /* Tombol simpan dan batal */
        form button,
        form a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 14px;
            text-decoration: none; /* Hapus garis bawah pada tombol */
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-align: center;
        }

        /* Tombol simpan */
        form button {
            background-color: #007bff; /* Biru */
            color: #fff;
            border: none;
        }

        form button:hover {
            background-color: #0056b3; /* Biru lebih gelap */
            transform: translateY(-2px); /* Efek angkat saat hover */
        }

        /* Tombol batal */
        form a {
            background-color: #ff0000; /* Merah */
            color: #fff;
            margin-left: 10px;
        }

        form a:hover {
            background-color: #820000; /* Merah lebih gelap */
            transform: translateY(-2px); /* Efek angkat saat hover */
        }

        /* Responsive untuk tampilan kecil */
        @media (max-width: 600px) {
            form {
                padding: 20px; /* Mengurangi padding untuk tampilan kecil */
            }

            form button,
            form a {
                font-size: 12px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <form method="POST" action="">
    <h2>Edit Paket Layanan</h2>
        <label>Nama Paket:</label>
        <input type="text" name="nama_paket" value="<?php echo $row['nama_paket']; ?>" required>

        <label>Harga:</label>
        <input type="number" name="harga" value="<?php echo $row['harga']; ?>" required>

        <label>Fitur:</label>
        <textarea name="fitur" required><?php echo $row['fitur']; ?></textarea>

        <label>Durasi Pengerjaan:</label>
        <input type="number" name="durasi_pengerjaan" value="<?php echo $row['durasi_pengerjaan']; ?>" required>

        <label>Jumlah Revisi:</label>
        <input type="number" name="jumlah_revisi" value="<?php echo $row['jumlah_revisi']; ?>" required>
 
        <button type="submit">Simpan</button>
        <a href="packages.php">Batal</a>
    </form>
</body>
</html>
<?php
$conn->close();
?>  