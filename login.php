<?php
include 'connect.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'], $_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM accounts WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                header("Location: home.php");
            } else {
                $poruka = "Pogrešna lozinka. Molimo pokušajte ponovo.";
            }
        } else {
            $poruka = "Korisnik sa datim korisničkim imenom ne postoji.";
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
    <title>Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .login-container {
        width: 300px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .login-container h2 {
        text-align: center;
    }
    .login-form input[type="text"],
    .login-form input[type="password"],
    .login-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .login-form input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
    }
    .login-form input[type="submit"]:hover {
        background-color: #437C4F;
    }
    .register-link {
        text-align: center;
    }
    a {
            text-decoration: none !important;
            color: #3BAC53 !important;
            text-align: center !important;
            }

        a:hover {
             color: #437C4F !important;
             text-decoration: none !important;
             cursor: pointer !important;
        }
</style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form class="login-form" method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="LOGIN">
    </form>
    <div class="register-link">
        <p>Nemate nalog? <a href="register.php">Registrujte se ovde</a><p><br><br>
        <strong><?php echo $poruka?><strong>
    </div>
</div>

</body>
</html>
