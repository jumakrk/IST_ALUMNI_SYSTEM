<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] == 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alumni Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Welcome, <?= $_SESSION['username'] ?></h1>
        <nav>
            <a href="post_job.php">Post a Job</a>
            <a href="view_jobs.php">View Jobs</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
</div>
</body>
</html>
