<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

require 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    
    if (isset($_POST['update_role'])) {
        $role = $_POST['role'];
        $sql = "UPDATE users SET role='$role' WHERE id='$user_id'";
        $conn->query($sql);
    }
    
    if (isset($_POST['delete_user'])) {
        $sql = "DELETE FROM users WHERE id='$user_id'";
        $conn->query($sql);
    }
    
    header("Location: manage_users.php");
    exit();
}

$sql = "SELECT id, username, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Manage Users</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($user = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$user['username']}</td>";
                echo "<td>{$user['role']}</td>";
                echo "<td>
                        <form action='manage_users.php' method='post'>
                            <input type='hidden' name='user_id' value='{$user['id']}'>
                            <select name='role'>
                                <option value='alumni'" . ($user['role'] == 'alumni' ? ' selected' : '') . ">Alumni</option>
                                <option value='admin'" . ($user['role'] == 'admin' ? ' selected' : '') . ">Admin</option>
                            </select>
                            <button type='submit' name='update_role'>Update Role</button>
                            <button type='submit' name='delete_user'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found.</td></tr>";
        }
        ?>
    </table>
    <a href="dashboard.php">Dashboard</a> |
    <a href="post_job.php">Post Job</a> |
    <a href="view_jobs.php">View Jobs</a> |
    <a href="logout.php">Logout</a>
</div>
</body>
</html>

<?php
$conn->close();
?>
