<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = htmlspecialchars($_GET['id']);
    $datum = htmlspecialchars($_POST['datum']);
    $vrijeme = htmlspecialchars($_POST['vrijeme']);
    $opis = htmlspecialchars($_POST['opis']);
    $sql_insert = "INSERT INTO termin (userID, datum, vrijeme, opis) VALUES ('$userID', '$datum', '$vrijeme', '$opis')";
    if ($conn->query($sql_insert) === TRUE) {
        $poruka = "Termin je uspješno rezervisan. Klikni za povratak na početnu.";
    } else {
        $poruka = "Greška pri rezervaciji termina! " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezervacija termina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .action-column {
            width: 100px;
        }
        .action-links {
            display: flex;
            justify-content: space-between;
        }
        .action-links a {
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
            background-color: #4caf50;
            color: #fff;
        }
        a {
            text-decoration: none;
            color: #3BAC53;
            text-align: center;
            }

        a:hover {
             color: #437C4F;
             text-decoration: none;
             cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Dashboard - Rezerviši termin</h2>
        <br>
        <h2>Novi termin</h2>
        <form method="post" action="">
            <label for="datum">Datum:</label>
            <input type="date" id="datum" name="datum" required>
            <label for="vrijeme">Vrijeme:</label>
            <input type="time" id="vrijeme" name="vrijeme" required>
            <label for="opis">Opis:</label>
            <input type="text" id="opis" name="opis" required>
            <input type="submit" value="Spasi">
        </form>
        <a href="home.php"><h1><?php echo $poruka?></h1></a>
    </div>
</body>
</html>
