<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'connect.php';
$message = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM user WHERE ID = $id";
    if ($conn->query($sql_delete) === TRUE) {
        $message = "Unos je uspješno obrisan.";
    } else {
        $message = "Greška pri brisanju unosa: " . $conn->error;
    }
} else {
    $message = "ID nije proslijeđen.";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Obrisi korisnika</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .dashboard-container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Dashboard - Obrisi korisnika</h2>
        <p><?php echo $message; ?></p>
        <br>
                <a href="home.php">Povratak na početnu</a>
    </div>
</body>
</html>
