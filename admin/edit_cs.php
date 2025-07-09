<?php
require '../db_conection.php';

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan!");
}

$id_cs = intval($_GET['id']);

// Ambil data customer services berdasarkan ID
$query = "SELECT * FROM customer_services WHERE id_cs = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_cs);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data tidak ditemukan!");
}

$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Services</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #001021;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 14px;
            color: #555555;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #007bff;
        }

        button.save-button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button.save-button:hover {
            background-color: #0056b3;
        }

        a.cancel-button {
            text-decoration: none;
            background-color: #ff4d4d;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 14px;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s;
        }

        a.cancel-button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Data Customer Services</h1>
    <form action="update_cs.php" method="post">
        <input type="hidden" name="id_cs" value="<?= htmlspecialchars($data['id_cs']) ?>">
        <div class="form-group">
            <label for="no_whatsapp">No WhatsApp:</label>
            <input type="text" id="no_whatsapp" name="no_whatsapp" value="<?= htmlspecialchars($data['no_whatsapp']) ?>" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <button type="submit" class="save-button">Simpan</button>
        <a href="customer_services.php" class="cancel-button">Batal</a>
    </form>
</div>
</body>
</html>
