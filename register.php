<?php
include 'connect.php';
$poruka = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM accounts WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $poruka = "Korisnik sa datim korisničkim imenom već postoji.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert = "INSERT INTO accounts (username, password) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("ss", $username, $hashedPassword);

            if ($stmt_insert->execute()) {
                $poruka = "Uspješno ste se registrovali.";
            } else {
                $poruka = "Greška prilikom registracije: " . $conn->error;
            }

            $stmt_insert->close();
        }

        $stmt->close();
    } else {
        $poruka = "Nisu poslati svi potrebni podaci.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .register-container {
        width: 300px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .register-container h2 {
        text-align: center;
    }
    .register-form input[type="text"],
    .register-form input[type="password"],
    .register-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .register-form input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }
    .register-form input[type="submit"]:hover {
        background-color: #437C4F;
    }
    .login-link {
        text-align: center;
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

<div class="register-container">
    <h2>Register</h2>
    <form class="register-form" method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="REGISTER">
    </form>
        <div class="login-link">
            <p>Već imate nalog. <a href="index.php">Prijavite se ovdje.</a>.</p><br><br>
            <strong><?php echo $poruka?><strong>
        </div>
</div>

</body>
</html>
