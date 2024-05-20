<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];
    
    $sql = "INSERT INTO jobs (title, description, user_id) VALUES ('$title', '$description', '$user_id')";
    $conn->query($sql);
    header("Location: view_jobs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Job</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Post a Job</h2>
    <form action="post_job.php" method="post">
        <label for="title">Job Title:</label>
        <input type="text" name="title" required>
        <br>
        <label for="description">Job Description:</label>
        <textarea name="description" required></textarea>
        <br>
        <input type="submit" value="Post Job">
    </form>
    <a href="admin_home.php">Dashboard</a> |
    <a href="view_jobs.php">View Jobs</a> |
    <a href="manage_users.php">Manage Users</a> |
    <a href="logout.php">Logout</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
