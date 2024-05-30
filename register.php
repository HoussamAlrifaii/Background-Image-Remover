<?php

session_start();


define("db_SERVER", "localhost");
define("db_USER", "root");
define("db_PASSWORD", "");
define("db_DBNAME", "registration");


$con = mysqli_connect(db_SERVER, db_USER, db_PASSWORD, db_DBNAME);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($email) && !empty($password)) {
      
        $stmt = $con->prepare("INSERT INTO register (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
           
            header("Location: login.php");
            exit();
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "All fields are required.";
    }
}


mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="login.svg" type="image/x-icon">
    
    <title>Register</title>
</head>
<body>
    <div class="login-card">
        <h2>Register</h2>
        <h3>Enter your credentials</h3>
        <?php
       
        if (!empty($message)) {
            echo "<p style='color: red;'>$message</p>";
        }
        ?>
        <form class="login-form" action="" method="POST">
            <input type="text" name="username" placeholder="Your username" id="username" required>
            <input type="email" name="email" placeholder="Your email" id="email" required>
            <input type="password" name="password" placeholder="Your password" id="password" required>
            <input type="password" placeholder="Confirm your password" required>
            <button type="submit">CREATE</button>
            <a href="index.html">Return</a>
            <button id="homeButton" class="btn btn-home btn-block mt-3" onclick="goToHome()">Return to Home</button>
        </form>
    </div>
</body>
</html>
