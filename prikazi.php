<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'connect.php';
$poruka='';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_select = "SELECT * FROM user WHERE ID = $id";
    $result = $conn->query($sql_select);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Nema podataka za prikaz.";
        exit();
    }
    $sql_select_termin = "SELECT * FROM termin WHERE userID = $id";
    $result_termin = $conn->query($sql_select_termin);   
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil korisnika</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            text-align: center;
        }
        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
        }
        .profile-avatar img {
            width: 100%;
            height: auto;
        }
        .profile-info {
            text-align: center;
            margin-top: 20px;
        }
        .profile-info p {
            margin: 10px 0;
        }
        .custom-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4caf50;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }
        .custom-button:hover {
        background-color: #437C4F;
    }
        a {
            text-decoration: none;
            color: #4caf50;
            text-align: center;
            }

        a:hover {
             color: #437C4F;
             text-decoration: none;
             cursor: pointer;
        }
        ul {
            list-style-type: none;
            }

    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h2>Profil korisnika</h2>
        </div>
        <div class="profile-avatar">
            <img src="https://unvi.edu.ba/wp-content/uploads/2023/04/Adobe_Express_20230408_1217500_1.png" alt="Avatar">
        </div>
        <div class="profile-info">
            <p><strong>Ime:</strong> <?php echo $row['ime']; ?></p>
            <p><strong>Prezime:</strong> <?php echo $row['prezime']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Adresa:</strong> <?php echo $row['adresa']; ?></p>
            <p><strong>Telefon:</strong> <?php echo $row['telefon']; ?></p>
            <p><strong>CreatedAt:</strong> <?php echo $row['createdAt']; ?></p>
            <?php 
                if ($result_termin->num_rows > 0) {
                     echo "<h2>Rezervisani termini</h2>";
                     echo "<ul>";
                     while ($row_termin = $result_termin->fetch_assoc()) {
                     echo "<li><strong>Datum:</strong> " . $row_termin['datum'] . ", <strong>Vrijeme:</strong> " . $row_termin['vrijeme'] . ", <strong>Opis:</strong> " . $row_termin['opis'] . "</li>";
                 }
                     echo "</ul>";
                } else {
                     $poruka = 'Korisnik nema rezervisanih termina';
                }

                } else {
                 echo "Korisnik nije proslijeđen.";
                 exit();
            }?>
            <p><strong><?php echo $poruka; ?></strong>
            <br><br>
            <a class="custom-button" href="termin.php?id=<?php echo $id; ?>">Rezerviši novi termin</a>
            <br><br>
            <h2><a href="home.php">Povratak na početnu</a></h2>
        </div>
        <br>
    </div>
</body>
</html>
