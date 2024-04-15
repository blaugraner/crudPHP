<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include 'connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ime = htmlspecialchars($_POST['ime']);
        $prezime = htmlspecialchars($_POST['prezime']);
        $email = htmlspecialchars($_POST['email']);
        $adresa = htmlspecialchars($_POST['adresa']);
        $telefon = htmlspecialchars($_POST['telefon']);
        $sql_update = "UPDATE user SET ime = '$ime', prezime = '$prezime', email = '$email', adresa = '$adresa', telefon = '$telefon' WHERE ID = $id";
        if ($conn->query($sql_update) === TRUE) {
            echo "Podaci su uspešno ažurirani.";
        } else {
            echo "Greška pri ažuriranju podataka: " . $conn->error;
        }
    }
    $sql_select = "SELECT * FROM user WHERE ID = $id";
    $result = $conn->query($sql_select);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard - Izmjena podataka</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .dashboard-container {
                    max-width: 800px;
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
            </style>
        </head>
        <body>
            <div class="dashboard-container">
                <h2>Dashboard - Izmjena podataka</h2>
                <form method="post" action="">
                    <label for="ime">Ime:</label>
                    <input type="text" id="ime" name="ime" value="<?php echo $row['ime']; ?>" required>

                    <label for="prezime">Prezime:</label>
                    <input type="text" id="prezime" name="prezime" value="<?php echo $row['prezime']; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>

                    <label for="adresa">Adresa:</label>
                    <input type="text" id="adresa" name="adresa" value="<?php echo $row['adresa']; ?>">

                    <label for="telefon">Telefon:</label>
                    <input type="text" id="telefon" name="telefon" value="<?php echo $row['telefon']; ?>">

                    <label for="id" style="display: none;">ID:</label>
                    <input type="text" id="id" name="id" value="<?php echo $row['ID']; ?>" disabled>

                    <input type="submit" value="Snimi promene">
                </form>
                <br>
                <a href="home.php">Povratak na početnu</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Nema rezultata za prikaz.";
    }
} else {
    echo "ID nije prosleđen.";
}
$conn->close();
?>
