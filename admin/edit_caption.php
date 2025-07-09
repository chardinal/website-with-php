<?php
include '../db_conection.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $conn->real_escape_string($_POST['content']);

    // Update query
    $sql = "UPDATE captiom SET conten = '$content' WHERE id_caption = 1"; // Pastikan ID sesuai
    if ($conn->query($sql) === TRUE) {
        header("Location: caption.php"); // Redirect to main page
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve current data
$sql = "SELECT * FROM captiom WHERE id_caption = 1"; // Pastikan ID sesuai
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No content available to edit.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Caption</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(352deg, rgb(0 0 42 / 92%), #333);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Edit Form Container */
        .edit-form {
        width: 100%;
        max-width: 650px;
        background: #010036;
        padding: 50px;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.8s ease-in-out;
        }

        /* Form Title */
        .edit-form h2 {
        margin-bottom: 20px;
        font-size: 40px;
        color: #ddc600;
        text-align: center;
        font-weight: 600;
        }

        /* Textarea Styles */
        .edit-form textarea {
        width: 96%;
        height: 209px;
        padding: 15px;
        border: 1px solid #dcdcdc;
        border-radius: 8px;
        resize: none;
        font-size: 1rem;
        color: #34495e;
        background-color: #f9f9f9;
        transition: border-color 0.3s, box-shadow 0.3s;
        }
        .edit-form textarea:focus {
            border-color: #74b9ff;
            box-shadow: 0 0 8px rgba(116, 185, 255, 0.8);
            outline: none;
        }

         /* Button Container */
         .button-container {
            display: flex;
            justify-content: center;
            gap: 15px; /* Spacing between buttons */
            margin-top: 20px;
        }

        /* Buttons */
        .edit-form button,
        .edit-form .cancel-button {
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .edit-form button {
            background-color: #4e73df;
            color: white;
        }

        .edit-form button:hover {
            background-color: #2c3e50;
            transform: translateY(-2px);
        }

        .edit-form .cancel-button {
            background-color: #d63031;
            color: white;
            border: none;
            text-decoration: none;
            text-align: center;
        }

        .edit-form .cancel-button:hover {
            background-color: #e74c3c;
            transform: translateY(-2px);
        }

        .edit-form button:active,
        .edit-form .cancel-button:active {
            transform: translateY(0);
        }

        /* Fade-in Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="edit-form">
        <h2>Edit About Us Content</h2>
        <form action="edit_caption.php" method="POST">
            <textarea name="content" required><?= htmlspecialchars($row['conten']) ?></textarea>
            <div class="button-container">
                <button type="submit">Save Changes</button>
                <a href="caption.php" class="cancel-button">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>