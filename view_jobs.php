<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'database_connection.php';

$sql = "SELECT jobs.title, jobs.description, users.username FROM jobs JOIN users ON jobs.user_id = users.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Jobs</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Job Listings</h2>
    <ul>
        <?php
        if ($result->num_rows > 0) {
            while ($job = $result->fetch_assoc()) {
                echo "<li><strong>{$job['title']}</strong> by {$job['username']}<br>{$job['description']}</li>";
            }
        } else {
            echo "<li>No jobs posted yet.</li>";
        }
        ?>
    </ul>
    <a href="admin_home.php">Dashboard</a> |
    <a href="post_job.php">Post Job</a> |
    <a href="manage_users.php">Manage Users</a> |
    <a href="logout.php">Logout</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
