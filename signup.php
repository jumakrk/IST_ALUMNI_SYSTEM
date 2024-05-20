<?php
require 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($username) || empty($email) || empty($password)) {
        echo "Username, email and password are required.";
        exit();
    }
    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Sign Up</h2>
    <form action="signup.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="email">Email:</label>
        <input type="text" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Sign Up">
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
