<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Welcome, Admin <?= $_SESSION['username'] ?></h1>
        <nav>
            <a href="post_job.php">Post a Job</a>
            <a href="view_jobs.php">View Jobs</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
</div>
</body>
</html>
