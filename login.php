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
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($username) && !empty($password)) {
       
        $stmt = $con->prepare("SELECT * FROM register WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

       
        if ($result->num_rows > 0) {
           
            $_SESSION['username'] = $username;
            header("Location: background.html");
            exit();
        } else {
           
            $message = "Invalid username or password.";
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
    
    <title>Log-in</title>
</head>
<body>
    <div class="login-card">
        <h2>Login</h2>
        <h3>Enter your credentials</h3>
        <?php
        
        if (!empty($message)) {
            echo "<p style='color: red;'>$message</p>";
        }
        ?>
        <form class="login-form" action="" method="POST">
            <input type="text" name="username" id="user-id" placeholder="Username" autocomplete="off" required>
            <input type="password" name="password" id="passwd-id" placeholder="Password" required>
            <a href="password.html" rel="noopener noreferrer">
                Forgot your password?
            </a>
            <button type="submit" name="login">LOGIN</button>
            <a href="register.php" rel="noopener noreferrer">
                Create a new account 
            </a>
            <a href="index.html" rel="noopener noreferrer">
                Return To Home
            </a>
        </form>
    </div>
</body>
</html>
