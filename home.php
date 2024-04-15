<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ime = htmlspecialchars($_POST['ime']);
    $prezime = htmlspecialchars($_POST['prezime']);
    $email = htmlspecialchars($_POST['email']);
    $adresa = htmlspecialchars($_POST['adresa']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $sql_insert = "INSERT INTO user (ime, prezime, email, adresa, telefon) VALUES ('$ime', '$prezime', '$email', '$adresa', '$telefon')";
    if ($conn->query($sql_insert) === TRUE) {
        $poruka = "Novi korisnik je uspješno dodat. Klikni ovdje da obrišeš obavijest.";
    } else {
        $poruka = "Greška pri dodavanju novog korisnika: " . $conn->error;
    }
}
$sql_select_all = "SELECT * FROM user";
$result_all = $conn->query($sql_select_all);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Prikaz i unos korisnika</title>
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
        <h2>Dashboard - Detalji</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>Ime</th>
                <th>Prezime</th>
                <th>Email</th>
                <th>Adresa</th>
                <th>Telefon</th>
                <th>CreatedAt</th>
                <th class="action-column">Akcija</th>
            </tr>
            <?php
            if ($result_all->num_rows > 0) {
                while ($row_all = $result_all->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row_all["ID"] . "</td>
                            <td>" . $row_all["ime"] . "</td>
                            <td>" . $row_all["prezime"] . "</td>
                            <td>" . $row_all["email"] . "</td>
                            <td>" . $row_all["adresa"] . "</td>
                            <td>" . $row_all["telefon"] . "</td>
                            <td>" . $row_all["createdAt"] . "</td>
                            <td class='action-column'>
                                <div class='action-links'>
                                    <a href='prikazi.php?id=" . $row_all["ID"] . "'>Prikazi</a>
                                    <a href='izmijeni.php?id=" . $row_all["ID"] . "'>Izmijeni</a>
                                    <a href='obrisi.php?id=" . $row_all["ID"] . "'>Obrisi</a>
                                </div>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>Nema unosa za prikaz.</td></tr>";
            }
            ?>
        </table>
        <br><br>
        <a href="home.php"><h1><?php echo $poruka?></h1></a>
        <br>
        <h2>Novi korisnik</h2>
        <form method="post" action="">
            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime" required>

            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="adresa">Adresa:</label>
            <input type="text" id="adresa" name="adresa">

            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" name="telefon">

            <input type="submit" value="Spasi">
        </form>
    </div>
</body>
</html>
