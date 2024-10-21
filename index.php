<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universitysystem";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch admin details
    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        
        // Verify password
        if ($password==$admin['password']) {
            // Successful login
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            header("Location: admin_dashboard.php"); 
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No admin found with this email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin <br> Login</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form  method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
    </div>
</body>
</html>
