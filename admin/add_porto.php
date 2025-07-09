<?php
// Informasi Database
include '../db_conection.php';

 // Nama database Anda

// Membuat koneksi
$conn = new mysqli($server, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Handle penambahan gambar
if (isset($_POST['add'])) {
    $kategori = $_POST['kategori'];

    // Proses upload file
    $target_dir = "../img/"; // Folder tujuan penyimpanan file
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;

    // Cek apakah file adalah gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check === false) {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek jika file sudah ada
    if (file_exists($target_file)) {
        echo "File sudah ada.";
        $uploadOk = 0;
    }

    // Cek ukuran file (maksimal 2MB)
    if ($_FILES["gambar"]["size"] > 2000000) {
        echo "Ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Cek ekstensi file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika semua validasi lolos
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Simpan ke database
            $sql = "INSERT INTO porto (kategori, gambar) VALUES ('$kategori', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Gambar berhasil diunggah dan disimpan!');
                        window.location.href = 'porto.php';
                    </script>";
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gambar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(352deg, rgb(0 0 42 / 92%), #333);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            background: rgba(0, 0, 42, 0.9);
            padding: 30px 50px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #ffdb00;
            font-size: 20px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #00cec9;
            box-shadow: 0 0 8px rgba(0, 206, 201, 0.5);
        }

        input[type="submit"],
        button {
            width: 48%;
            padding: 12px;
            background-color: #0600ff;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            display: inline-block;
            margin: 5px 1%;
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #019d92;
            transform: translateY(-2px);
        }

        input[type="submit"]:active,
        button:active {
            transform: translateY(0);
        }

        button {
            background-color: #d63031;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* Preview Gambar */
        #preview {
            margin-top: 20px;
            display: none;
            text-align: center;
        }

        #preview img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tambahan agar responsif */
        @media (max-width: 480px) {
            form {
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }

            input[type="submit"],
            button {
                font-size: 14px;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <form method="POST" action="add_porto.php" enctype="multipart/form-data">
        <h1>Tambah Gambar</h1>
        <label for="kategori">Kategori:</label>
        <input type="text" name="kategori" required>
        <label for="gambar">Upload Gambar:</label>
        <input type="file" name="gambar" accept="image/*" required>

        <!-- Preview gambar -->
        <div id="preview"></div>

        <!-- Tombol -->
        <input type="submit" name="add" value="Tambah Gambar">
        <button type="button" onclick="window.location.href='porto.php';">Batal</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.querySelector('input[type="file"]');
            const preview = document.getElementById('preview');
            const previewImg = document.createElement('img');

            fileInput.addEventListener('change', function () {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        preview.innerHTML = ''; // Hapus gambar sebelumnya
                        preview.appendChild(previewImg);
                        preview.style.display = 'block'; // Tampilkan area preview
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>
</html>