<?php
require 'database_connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT id, username, password, role FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            
            if ($row['role'] == 'admin') {
                header("Location: admin_home.php");
            } else {
                header("Location: alumni_home.php");
            }
            exit();
        } else {
            echo "Invalid Credentials.";
        }
    } else {
        echo "Invalid Credentials";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
    <p>I don't have an account? <a href="signup.php">Sign Up</a></p>
</div>
</body>
</html>
